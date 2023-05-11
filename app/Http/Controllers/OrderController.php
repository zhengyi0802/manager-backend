<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Member;
use App\Models\Distrobuter;
use App\Models\Reseller;
use App\Models\BonusList;
use App\Enums\UserRole;
use App\Enums\OrderFlow;
use App\Enums\BonusStatus;
use App\SMS\SmsSend;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role == UserRole::Administrator || $user->role == UserRole::Accounter) {
            $orders = Order::get();
        } else if ($user->role == UserRole::Manager) {
            $customers = $this->customers($user->id)->pluck('id');
            $customer_array = $customers->toArray();
            $distrobuterIds = $this->distrobuterIds($user->id);
            foreach ($distrobuterIds as $distrobuterId) {
                $customs = $this->customers($distrobuterId)->pluck('id');
                if (count($customs) > 0) {
                    $custom_array = $customs->toArray();
                    array_push($customer_array, $custom_array);
                }
            }
            $resellerIds = $this->resellerIds($user->id);
            foreach ($resellerIds as $resellerId) {
                $customs = $this->customers($resellerId)->pluck('id');
                if (count($customs) > 0) {
                    $custom_array = $customs->toArray();
                    array_push($customer_array, $custom_array);
                }
                $distrobuterIds = $this->distrobuterIds($resellerId);
                foreach ($distrobuterIds as $distrobuterId) {
                    $customs = $this->customers($distrobuterId)->pluck('id');
                    if (count($customs) > 0) {
                        $custom_array = $customs->toArray();
                        array_push($customer_array, $custom_array);
                    }
                }
            }
            $orders = Order::whereIn('member_id', $customer_array)->get();
        } else if ($user->role == UserRole::Reseller) {
            $customers = $this->customers($user->id)->pluck('id');
            $customer_array = $customers->toArray();
            $distrobuterIds = $this->distrobuterIds($user->id);
            foreach ($distrobuterIds as $distrobuterId) {
                $customs = $this->customers($distrobuterId)->pluck('id');
                if (count($customs) > 0) {
                    $custom_array = $customs->toArray();
                    array_push($customer_array, $custom_array);
                }
            }
            $orders = Order::whereIn('member_id', $customer_array)->get();
        } else if ($user->role == UserRole::Distrobuter) {
            $customerIds = $this->customers($user->id)->pluck('id');
            $customer_array = $customerIds->toArray();
            $orders = Order::whereIn('member_id', $customer_array)->get();
        } else {
            $orders = Order::where('member_id', $user->member->id)->get();
        }

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $data = $request->all();

        if (array_key_exists('cancel_flag', $data)) {
            if ($data['cancel_flag']) {
                $data['flow_status'] = OrderFlow::Cancelled;
            }
        }
        $order->update($data);

        if ($data['flow_status'] == OrderFlow::Completed) {
            if ($order->is_manager) {
                //return redirect()->route('orders.index');
                $distrobuter = $order->manager;
            } else {
                $distrobuter = $order->member->introducer;
                $member = $distrobuter->member;
            }
            if ($distrobuer->role == UserRole::Manager) {
                $manager = $distrobuter->manager;
                $amount  = $manager->bonus;
            } else {
                if ($distrobuter->role == UserRole::Reseller) {
                    $amount = $member->bonus + $member->share;
                    $manager = $member->introducer->manager;
                } else if ($distrobuter->role == UserRole::Distrobuter) {
                    $amount = $member->bonus;
                    $bonusitem = [
                        'member_id'       => $member->id,
                        'order_id'        => $order->id,
                        'amount'          => $amount,
                        'process_status'  => BonusStatus::Unchecked,
                    ];
                    BonusList::create($bonusitem);
                    $member = $member->introducer->member;
                    $amount = $member->share;
                    $manager = $member->introducer->manager;
                }
                $bonusitem = [
                    'member_id'       => $member->id,
                    'order_id'        => $order->id,
                    'amount'          => $amount,
                    'process_status'  => BonusStatus::Unchecked,
                ];
                BonusList::create($bonusitem);
                $amount = $manager->share;
            }
            $bonusitem = [
                'member_id'       => $manager->id,
                'manager_used'    => true,
                'order_id'        => $order->id,
                'amount'          => $amount,
                'process_status'  => BonusStatus::Unchecked,
            ];
            BonusList::create($bonusitem);
        }

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
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

    public function smssend(Order $order) {
       $sms = new SmsSend();
       $phone = $order->phone;
       $msg = '大電視申領之訂單編號 : '.$order->id.'通知繳款';
       $sms = $sms->send($phone, $msg);
       //var_dump($sms);
       return view('orders.show', compact('order'))->with(compact('sms'));
    }

    public function customers($user_id) {
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
