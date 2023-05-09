<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use App\Enums\UserRole;
use App\Uploads\FileUpload;

class ResellerController extends Controller
{

    public function index() {
        $user = auth()->user();
        if ($user->role == UserRole::Manager) {
            $resellers = Member::leftJoin('users', 'users.id', 'members.user_id')
                           ->select('members.*')
                           ->where('users.role', UserRole::Reseller)
                           ->where('members.introducer_id', $user->id)
                           ->get();
        } else if ($user->role == UserRole::Reseller) {
            $resellers = Member::leftJoin('users', 'users.id', 'members.user_id')
                           ->select('members.*')
                           ->where('users.id', $user->id)
                           ->get();
        } else if ($user->role == UserRole::Administrator || $user->role == UserRole::Accounter) {
            $resellers = Member::leftJoin('users', 'users.id', 'members.user_id')
                           ->select('members.*')
                           ->where('users.role', UserRole::Reseller)
                           ->get();
        }
        return view('resellers.index', compact('resellers'));
    }

    public function create() {
        return view('resellers.create');
    }

    public function store(Request $request) {
        $creator = auth()->user();
        $data = $request->all();
        $check_user = User::where('line_id', $data['line_id'])
                          ->orWhere('phone', $data['phone'])
                          ->first();

        $introducer = User::where('line_id', $data['introducer'])->first();

        if ($introducer->role == UserRole::Manager) {
            $share_status = $introducer->manager->share_status;
        } else {
            $share_status = $introducer->member->share_status;
        }
        $user = [
            'name'       => $data['name'],
            'phone'      => $data['phone'],
            'line_id'    => $data['line_id'],
            'email'      => $data['email'],
            'password'   => bcrypt($data['password']),
            'role'       => UserRole::Reseller,
            'created_by' => $creator->id,
            'status'     => true,
        ];

        if (is_null($check_user)) {
            $user = User::create($user);
        } else {
            $check_user->update($user);
            $user = $check_user;
        }

        $pid_image_1 = null;
        $pid_image_2 = null;
        if ($request->file()) {
            $upload1 = new FileUpload();
            $pid_image_1 = $upload1->fileUpload($request, 'pid_image_1');
            $upload2 = new FileUpload();
            $pid_image_2 = $upload2->fileUpload($request, 'pid_image_2');
        }

        $member = [
            'user_id'        => $user->id,
            'introducer_id'  => $introducer->id,
            'address'        => $data['address'],
            'pid'            => $data['pid'],
            'pid_image_1'    => $pid_image_1,
            'pid_image_2'    => $pid_image_2,
            'bonus'          => $data['bonus'],
            'share'          => $data['share'],
            'share_status'   => $share_status,
            'created_by'     => $creator->id,
        ];
        if (is_null($check_user)) {
            Member::create($member);
        } else {
            $reseller = Member::where('user_id', $user->id)->first();
            if (is_null($reseller)) {
                $reseller = Member::create($member);
            } else {
                $reseller->update($member);
            }
        }

        return redirect()->route('resellers.index');
    }

    public function show(Member $reseller) {
        return view('resellers.show', compact('reseller'));
    }

    public function edit(Member $reseller) {
        return view('resellers.edit', compact('reseller'));
    }

    public function update(Request $request, Member $reseller) {
        $data = $request->all();
        $user = $reseller->user;
        $userdata = [
            'phone'      => $data['phone'],
            'line_id'    => $data['line_id'],
            'email'      => $data['email'],
        ];
        if ($data['newpassword'] != null) {
            $userdata['password'] = bcrypt($data['newpassword']);
        }
        $user->update($userdata);

        $pid_image_1 = null;
        $pid_image_2 = null;
        if ($request->file()) {
            $upload1 = new FileUpload();
            $pid_image_1 = $upload1->fileUpload($request, 'pid_image_1');
            $upload2 = new FileUpload();
            $pid_image_2 = $upload2->fileUpload($request, 'pid_image_2');
        }
        $member = [
            'address'        => $data['address'],
            'pid'            => $data['pid'],
            'bank'           => $data['bank'],
            'bank_name'      => $data['bank_name'],
            'account'        => $data['account'],
            'status'         => $data['status'],
        ];
        if (!is_null($pid_image_1)) {
            $member['pid_image_1'] = $pid_image_1;
        }
        if (!is_null($pid_image_2)) {
            $member['pid_image_2'] = $pid_image_2;
        }
        if (array_key_exists('bonus', $data)) {
            $member['bonus'] = $data['bonus'];
        }

        if (array_key_exists('share', $data)) {
            $member['share'] = $data['share'];
        }
        $reseller->update($member);

        return redirect()->route('resellers.index');
    }

    public function destroy(Member $reseller)
    {
        $user = auth()->user();
        if (($user->id == 2)
           || ($user->id == $reseller->introducer->id)
           || ($user->id == $reseller->created_by)) {
            $userR = $reseller->user;
            $userR->delete();
            $reseller->delete();
        } else {
            $reseller->status = false;
            $reseller->save();
        }

        return redirect()->route('resellers.index');
    }
}
