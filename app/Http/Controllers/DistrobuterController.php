<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use App\Enums\UserRole;
use App\Uploads\FileUpload;

class DistrobuterController extends Controller
{
    public function index() {
        $user = auth()->user();
        if ($user->role == UserRole::Administrator || $user->role == UserRole::Accounter) {
            $distrobuters = Member::leftJoin('users', 'users.id', 'members.user_id')
                                  ->select('members.*')
                                  ->where('users.role', UserRole::Distrobuter)
                                  ->get();
        } else if($user->role == UserRole::Manager) {
            $resellers = Member::leftJoin('users', 'users.id', 'members.user_id')
                               ->select('members.*')
                               ->where('users.role', UserRole::Reseller)
                               ->where('introducer_id', $user->id)
                               ->get()
                               ->pluck('user_id');
            $resellers->push($user->id);
            $distrobuters = Member::leftJoin('users', 'users.id', 'members.user_id')
                                  ->select('members.*')
                                  ->where('users.role', UserRole::Distrobuter)
                                  ->whereIn('introducer_id', $resellers)
                                  ->get();
        } else if($user->role == UserRole::Reseller) {
            $distrobuters = Member::leftJoin('users', 'users.id', 'members.user_id')
                                  ->select('members.*')
                                  ->where('users.role', UserRole::Distrobuter)
                                  ->where('introducer_id', $user->id)
                                  ->get();
        } else if($user->role == UserRole::Distrobuter) {
            $distrobuters = Member::leftJoin('users', 'users.id', 'members.user_id')
                                  ->select('members.*')
                                  ->where('user_id', $user->id)
                                  ->get();
        }

        return view('distrobuters.index', compact('distrobuters'));
    }

    public function create() {
        return view('distrobuters.create');
    }

    public function store(Request $request) {
        $creator = auth()->user();
        $data = $request->all();
        $check_user = User::where('line_id', $data['line_id'])
                          ->orWhere('phone', $data['phone'])
                          ->get();
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
            'role'       => UserRole::Distrobuter,
            'created_by' => $creator->id,
            'status'     => true,
        ];
        if (count($check_user) == 0) {
            $user = User::create($user);
        } else {
            $check = $check_user->first();
            $check->update($user);
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
            'share_status'   => $share_status,
            'created_by'     => $creator->id,
        ];
        if (array_key_exists('bonus', $data)) {
            $member['bonus'] = $data['bonus'];
        }
        if (count($check_user) == 0) {
            Member::create($member);
        } else {
            $check = $check_user->first();
            $distrobuter = Member::where('user_id', $check->id)->first();
            $distrobuter->update($member);
        }

        return redirect()->route('distrobuters.index');
    }

    public function show(Member $distrobuter) {
        return view('distrobuters.show', compact('distrobuter'));
    }

    public function edit(Member $distrobuter) {
        return view('distrobuters.edit', compact('distrobuter'));
    }

    public function update(Request $request, Member $distrobuter) {
        $data = $request->all();
        $user = $distrobuter->user;

        $introducer = User::where('line_id', $data['introducer'])->first();
        if ($introducer->role == UserRole::Manager) {
            $share_status = $introducer->manager->share_status;
        } else {
            $share_status = $introducer->member->share_status;
        }
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
            'introducer_id'  => $introducer->id,
            'address'        => $data['address'],
            'pid'            => $data['pid'],
            'pid_image_1'    => $pid_image_1,
            'pid_image_2'    => $pid_image_2,
            'bank'           => $data['bank'],
            'bank_name'      => $data['bank_name'],
            'account'        => $data['account'],
            'share_status'   => $share_status,
            'status'         => $data['status'],
        ];
        if (!is_null($pid_image_1)) {
            $member['pid_image_1'] = $pid_image_1;
        }
        if (!is_null($pid_image_2)) {
            $member['pid_image_2'] = $pid_image_2;
        }
        if (array_key_exists('bonus', $data)) {
            $member['bonus'] = ($share_status ? $data['bonus'] : 0);
        }
        $distrobuter->update($member);

        return redirect()->route('distrobuters.index');
    }

    public function destroy(Member $distrobuter) {
        $user = auth()->user();
        if (($user->id == 2)
           || ($user->id == $distrobuter->introducer->id)
           || ($user->id == $distrobuter->created_by)) {
            $userR = $distrobuter->user;
            $userR->delete();
            $distrobuter->delete();
        } else {
            $distrobuter->status = false;
            $distrobuter->save();
        }

        return redirect()->route('distrobuters.index');
    }

}
