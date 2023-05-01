<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Manager;
use App\Models\Member;
use App\Enums\UserRole;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role == UserRole::Administrator || $user->role == UserRole::Accounter) {
            $admin = $user;
            return redirect()->route('admins.show', compact('admin'));
        } else if ($user->role == UserRole::Manager) {
            $manager = $user->manager;
            return redirect()->route('managers.show', compact('manager'));
        } else if ($user->role == UserRole::Reseller) {
            $reseller = $user->member;
            return redirect()->route('resellers.show', compact('reseller'));
        } else if ($user->role == UserRole::Distrobuter) {
            $distrobuter = $user->member;
            return redirect()->route('distrobuters.show', compact('distrobuter'));
        } else if ($user->role == UserRole::Member) {
            $member = $user->member;
            return redirect()->route('members.show', compact('member'));
        }
        return view('home');
    }
}
