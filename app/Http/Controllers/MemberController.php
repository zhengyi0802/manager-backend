<?php

namespace App\Http\Controllers;

use App\Uploads\FileUpload;
use App\Models\Member;
use App\Models\User;
use App\Models\Order;
use App\Enums\UserRole;
use App\Enums\OrderFlow;
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
            $customerIds = $this->customerList($user->id)->pluck('user_id');
            $customer_array = $customerIds->toArray();
            $distrobuterIds = $this->distrobuterIds($user->id);
            foreach ($distrobuterIds as $distrobuterId) {
                $customIds1 = $this->customerList($distrobuterId)->pluck('user_id');
                if (count($customIds1) > 0) {
                    $custom_array = $customIds1->toArray();
                    array_push($customer_array, $custom_array);
                }
            }
            $resellerIds = $this->resellerIds($user->id);
            foreach ($resellerIds as $resellerId) {
                $customIds1 = $this->customerList($resellerId)->pluck('user_id');
                if (count($customIds1) > 0) {
                    $custom_array = $customIds1->toArray();
                    array_push($customer_array, $custom_array);
                }
                $distrobuterIds = $this->distrobuterIds($resellerId);
                foreach ($distrobuterIds as $distrobuterId) {
                    $customIds1 = $this->customerList($distrobuterId)->pluck('user_id');
                    if (count($customIds1) > 0) {
                        $custom_array = $customIds1->toArray();
                        array_push($customer_array, $custom_array);
                    }
                }
            }
            $members = Member::leftJoin('users', 'members.user_id', 'users.id')
                             ->select('members.*')
                             ->where('users.role', UserRole::Member)
                             ->whereIn('user_id', $customer_array)
                             ->get();
         } else if ($user->role == UserRole::Reseller) {
            $customerIds = $this->customerList($user->id)->pluck('user_id');
            $customer_array = $customerIds->toArray();
            $distrobuterIds = $this->distrobuterIds($user->id);
            foreach ($distrobuterIds as $distrobuterId) {
                $customIds1 = $this->customerList($distrobuterId)->pluck('user_id');
                if (count($customIds1) > 0) {
                    $custom_array = $customIds1->toArray();
                    array_push($customer_array, $custom_array);
                }
            }
            $members = Member::leftJoin('users', 'members.user_id', 'users.id')
                             ->select('members.*')
                             ->where('users.role', UserRole::Member)
                             ->whereIn('user_id', $customer_array)
                             ->get();
        } else if ($user->role == UserRole::Distrobuter) {
            $members = $this->customerList($user->id);
        } else if ($user->role == UserRole::Member) {
            $members = Member::leftJoin('users', 'members.user_id', 'users.id')
                             ->select('members.*')
                             ->where('users.role', UserRole::Member)
                             ->where('user_id', $user->id)
                             ->get();
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
                'email'      => $data['email'],
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
        } else {
            $user = $check_user->first();
            $member = $user->member;
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
            'model'          => $data['model'],
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
            'email'      => $data['email'],
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
        $user = auth()->user();

        if (false && ($user->id == 2
           || $user->id == $reseller->introducer->id
           || $user->id == $reseller->created_by)) {
            $orders = $member->orders;
            foreach ($orders as $order) {
                $order->delete();
            }
            $userm = $member->user;
            $userm->delete();
            $member->delete();
        } else {
            $orders = $member->orders;
            foreach ($orders as $order) {
                $order->OrderFlow::Cancelled;
                $order->save();
            }
            $userm = $member->user;
            $user->status = false;
            $user->save();
            $member->status = false;
            $member->save();
        }

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

    public function customerList($user_id) {
        $customers = Member::leftJoin('users', 'members.user_id', 'users.id')
                           ->select('members.*')
                           ->where('users.role', UserRole::Member)
                           ->where('members.introducer_id', $user_id)
                           ->get();
       return $customers;
    }

    public function distrobuterIds($user_id) {
        $distrobuterIds = Member::leftJoin('users', 'members.user_id', 'users.id')
                           ->select('members.*')
                           ->where('users.role', UserRole::Distrobuter)
                           ->where('members.introducer_id', $user_id)
                           ->get()
                           ->pluck('user_id');
        return $distrobuterIds;
    }

    public function resellerIds($user_id) {
        $distrobuterIds = Member::leftJoin('users', 'members.user_id', 'users.id')
                           ->select('members.*')
                           ->where('users.role', UserRole::Reseller)
                           ->where('members.introducer_id', $user_id)
                           ->get()
                           ->pluck('user_id');
        return $distrobuterIds;
    }

}
