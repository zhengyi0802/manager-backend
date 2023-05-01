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
        if ($user->role == UserRole::Manager) {
            $orders = $user->member->orders;
            $resellers = $this->resellers($user->id);
            foreach ($resellers as $reseller) {
                $user_id = $reseller->user->id;
                $orders->push($reseller->orders);
                $distrobuters = $this->distrobuters($user_id);
                foreach ($distrobuters as $distrobuter) {
                    $orders->push($distrobuter->orders);
                    $user_id = $distrobuter->user->id;
                    $members = $this->customers($user_id);
                    foreach ($members as $member) {
                        $orders->push($member->orders);
                    }
                }
            }
            $distrobuters = $this->distrobuters($user->id);
            foreach ($distrobuters as $distrobuter) {
                $user_id = $distrobuter->user->id;
                $orders->push($distrobuter->orders);
                $members = $this->customers($user_id);
                foreach($members as $member) {
                    $orders->push($member->orders);
                }
            }
        } else if ($user->role == UserRole::Reseller) {
            $orders = $user->member->orders;
            $distrobuters = $this->distrobuters($user->id);
            foreach ($distrobuters as $distrobuter) {
                $user_id = $distrobuter->user->id;
                $orders->push($distrobuter->orders);
                $members = $this->customers($user_id);
                foreach($members as $member) {
                    $orders->push($member->orders);
                }
            }
        } else if ($user->role == UserRole::Distrobuter) {
            $orders  = $user->member->orders;
            $members = $this->customers($user->id);
            foreach($members as $member) {
                $orders->push($member->orders);
            }
        } else if ($user->role == UserRole::Member) {
            $orders = $user->member->orders;
        } else {
            $orders = Order::get();
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
        $order->update($data);

        if ($data['flow_status'] == OrderFlow::Completed) {
            $distrobuter = $order->member->introducer;
            $member = $distrobuter->member;
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

    public function customers($user_id) {
        $customers = Member::leftJoin('users', 'members.user_id', 'users.id')
                           ->select('members.*')
                           ->where('users.role', UserRole::Member)
                           ->where('members.introducer_id', $user_id)
                           ->get();
       return $customers;
    }

}
