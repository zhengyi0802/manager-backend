<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use App\Enums\UserRole;

class ResellerController extends Controller
{

    public function index() {
        $user = auth()->user();
        if ($user->role < UserRole::Reseller) {
            $resellers = Member::leftJoin('users', 'users.id', 'members.user_id')
                           ->where('users.role', UserRole::Reseller)
                           ->get();
        } else if ($user->role == UserRole::Reseller) {
            $resellers = Member::leftJoin('users', 'users.id', 'members.user_id')
                           ->where('users.id', $user->id)
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
        $introducer = $creator;
        $user = [
            'name'       => $data['name'],
            'phone'      => $data['phone'],
            'line_id'    => $data['line_id'],
            'password'   => bcrypt($data['password']),
            'role'       => UserRole::Reseller,
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
        $reseller->update($member);

        return redirect()->route('resellers.index');
    }

    public function destory(Member $reseller) {
        $reseller->status = false;
        $reseller->save();
        return redirect()->route('resellers.index');
    }
}
