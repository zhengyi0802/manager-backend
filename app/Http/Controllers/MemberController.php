<?php

namespace App\Http\Controllers;

use App\Uploads\FileUpload;
use App\Models\Member;
use App\Models\User;
use App\Models\Order;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role == UserRole::Manager) {
           $members = $this->customers($user->id);
           $resellers = $this->resellers($user->id);
           foreach ($resellers as $reseller) {
              $user_id = $reseller->user->id;
              $customers = $this->customers($user_id);
              $members->push($customers);
              $distrobuters = $this->distrobuters($user_id);
              foreach ($distrobuters as $distrobuter) {
                      $user_id = $distrobuter->user->id;
                      $customers = $this->customers($user_id);
                      $members->push($customers);
              }
           }
           $distrobuters = $this->distrobuters($user->id);
           foreach ($distrobuters as $distrobuter) {
               $user_id = $distrobuter->user->id;
               $customers = $this->customers($user_id);
               $members->push($customers);
           }
        } else if ($user->role == UserRole::Reseller) {
           $mnembers = $this->customers($user->id);
           $distrobuters = $this->distrobuters($user->id);
           foreach ($distrobuters as $distrobuter) {
                   $user_id = $distrobuter->user->id;
                   $customers = $this->customers($user_id);
                   $members->push($customers);
           }
        } else if ($user->role == UserRole::Distrobuter) {
            $members = $this->customers($user->id);
        } else {
            $members = Member::leftJoin('users', 'members.user_id', 'users.id')
                             ->select('members.*')
                             ->where('users.role', UserRole::Member)
                             ->get();
        }
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $creator = auth()->user();
        $data = $request->all();
        $check_user = User::where('line_id', $data['line_id'])
                          ->orWhere('phone', $data['phone'])
                          ->get();

        if (count($check_user) == 0) {
            $introducer = User::where('line_id', $data['introducer'])->first();
            $user = [
                'name'       => $data['name'],
                'phone'      => $data['phone'],
                'line_id'    => $data['line_id'],
                'password'   => bcrypt($data['password']),
                'role'       => UserRole::Member,
                'created_by' => $creator->id,
                'status'     => true,
            ];
            $user = User::create($user);

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
                'created_by'     => $creator->id,
            ];
            $member = Member::create($member);
        }
        $order_latest = Order::orderBy('id', 'desc')->get()->first();
        if ($order_latest == null) {
            $orderlatest = 0;
        } else {
            $orderlatest = $order_latest->id;
        }

        $idinit = ((now()->year-2000)*100+(now()->month))*10000+1;

        if ($idinit <= $orderlatest) {
            $id = $orderlatest+1;
        } else {
            $id = $idinit;
        }
        $order = [
            'id'             => $id,
            'member_id'      => $member->id,
            'phone'          => $data['phone'],
            'address'        => $data['address'],
        ];
        Order::create($order);

        return redirect()->route('members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $data = $request->all();
        $user = $member->user;
        $userdata = [
            'phone'      => $data['phone'],
            'line_id'    => $data['line_id'],
            'status'     => true,
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
        $memberdata = [
            'address'        => $data['address'],
        ];
        $member->update($memberdata);

        return redirect()->route('members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->status = false;
        $member->save();

        return redirect()->route('members.index');
    }

    public function upgradeR(Member $member) {
        //dd($member);
        $user = $member->user;
        $user->role = UserRole::Reseller;
        $user->save();

        return redirect()->route('resellers.index');
    }

    public function upgradeD(Member $member) {
        //dd($member);
        $user = $member->user;
        $user->role = UserRole::Distrobuter;
        $user->save();

        return redirect()->route('distrobuters.index');
    }

    public function customers($user_id) {
        $customers = Member::leftJoin('users', 'members.user_id', 'users.id')
                           ->select('members.*')
                           ->where('users.role', UserRole::Member)
                           ->where('members.introducer_id', $user_id)
                           ->get();
       return $customers;
    }

    public function resellers($user_id) {
        $resellers = Member::leftJoin('users', 'members.user_id', 'users.id')
                              ->select('members.*')
                              ->where('users.role', UserRole::Reseller)
                              ->where('members.introducer_id', $user_id)
                              ->get();
       return $resellers;
    }

    public function distrobuters($user_id) {
        $distrobuters = Member::leftJoin('users', 'members.user_id', 'users.id')
                              ->select('members.*')
                              ->where('users.role', UserRole::Distrobuter)
                              ->where('members.introducer_id', $user_id)
                              ->get();
       return $distrobuters;
    }

}

