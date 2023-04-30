<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use App\Enums\UserRole;

class DistrobuterController extends Controller
{
    public function index() {
        $user = auth()->user();
        if ($user->role <= UserRole::Accounter) {
            $distrobuters = Member::leftJoin('users', 'users.id', 'members.user_id')
                           ->select('members.*')
                           ->where('users.role', UserRole::Distrobuter)
                           ->get();
        } else if($user->role == UserRole::Reseller) {
            $distrobuters = Member::leftJoin('users', 'users.id', 'members.user_id')
                                  ->select('members.*')
                                  ->where('users.role', UserRole::Distrobuter)
                                  ->where('introducer_id', $user->id)
                                  ->get();
        } else if($user->role == UserRole::Distrobuter) {
            $distrobuters = Member::leftJoin('users', 'users.id', 'members.user_id')
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
        $introducer = User::where('line_id', $data['introducer'])->get()->first();
        $user = [
            'name'       => $data['name'],
            'phone'      => $data['phone'],
            'line_id'    => $data['line_id'],
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
            'bank'           => $data['bank'],
            'bank_name'      => $data['bank_name'],
            'account'        => $data['account'],
            'bonus'          => $data['bonus'],
            'created_by'     => $creator->id,
        ];

        if (count($check_user) == 0) {
            Member::create($member);
        } else {
            $check = $check_user->first()
            $distrobuter = Member::where('user_id', $check->id)->get()->first();
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
        $userdata = [
            'phone'      => $data['phone'],
            'line_id'    => $data['line_id'],
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
            'pid_image_1'    => $pid_image_1,
            'pid_image_2'    => $pid_image_2,
            'bank'           => $data['bank'],
            'bank_name'      => $data['bank_name'],
            'account'        => $data['account'],
            'bonus'          => $data['bonus'],
            'status'         => $data['status'],
        ];
        $distrobuter->update($member);

        return redirect()->route('distrobuters.index');
    }

    public function destroy(Member $distrobuter) {
        $distrobuter->status = false;
        $distrobuter->save();
        return redirect()->route('distrobuters.index');
    }

}
