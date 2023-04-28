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
        if ($user->role >= UserRole::Reseller) {
            $orders = Order::leftJoin('members', 'members.id', 'orders.member_id')
                           ->select('members.*', 'orders.*')
                           ->where('members.introducer_id', $user->id)
                           ->get();
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
        if ($data['flow_status'] >= OrderFlow::Completed) {
            $distrobuter = $order->member->introducer;
            $member = $distrobuter->member;
            if ($distrobuter->role == UserRole::Reseller) {
                $amount = $member->bonus + $member->share;
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
            }
            $bonusitem = [
                'member_id'       => $member->id,
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
}
