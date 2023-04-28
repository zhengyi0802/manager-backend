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
                           ->where('users.role', UserRole::Distrobuter)
                           ->get();
        } else if($user->role == UserRole::Reseller) {
            $distrobuters = Member::leftJoin('users', 'users.id', 'members.user_id')
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
        $user = User::create($user);
        $member = [
            'user_id'        => $user->id,
            'introducer_id'  => $introducer->id,
            'address'        => $data['address'],
            'pid'            => $data['pid'],
            'bank'           => $data['bank'],
            'bank_name'      => $data['bank_name'],
            'account'        => $data['account'],
            'created_by'     => $creator->id,
        ];
        Member::create($member);

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
        $member = [
            'address'        => $data['address'],
            'pid'            => $data['pid'],
            'bank'           => $data['bank'],
            'bank_name'      => $data['bank_name'],
            'account'        => $data['account'],
        ];
        $distrobuter->update($member);

        return redirect()->route('distrobuters.index');
    }

    public function destory(Member $distrobuter) {
        $distrobuter->status == false;
        $distrobuter->save();
        return redirect()->route('distrobuters.index');
    }

}
