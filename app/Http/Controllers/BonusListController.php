<?php

namespace App\Http\Controllers;

use App\Models\BonusList;
use App\Models\Bonus;
use App\Models\Member;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\BonusStatus;
use Illuminate\Http\Request;

class BonusListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role <= UserRole::Accounter) {
            $bonuslists = BonusList::where('process_status', '<' , BonusStatus::Transfered)
                                   ->get();
        } else {
            $bonuslists = BonusList::where('process_status', '<' , BonusStatus::Transfered)
                                   ->where('member_id', $user->member->id)
                                   ->get();
        }
        return view('bonuslists.index', compact('bonuslists'));
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
     * @param  \App\Models\BonusList  $bonusList
     * @return \Illuminate\Http\Response
     */
    public function show(BonusList $bonusList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BonusList  $bonusList
     * @return \Illuminate\Http\Response
     */
    public function edit(BonusList $bonusList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BonusList  $bonusList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BonusList $bonusList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BonusList  $bonusList
     * @return \Illuminate\Http\Response
     */
    public function destroy(BonusList $bonusList)
    {
        //
    }

    public function check()
    {
        $final = now()->subDays(2);
        $members = BonusList::select('member_id')->where('created_at', '<=', $final)->get();
        $member_ids = $members->pluck('member_id')->unique();
        if (count($members) == 0) {
            return redirect()->route('bonuslists.index');
        }
        foreach($member_ids as $member_id) {
            //$member_id = $member->member_id;
            $bonuslists = BonusList::where('member_id', $member_id)
                                   ->where('process_status', 1)
                                   ->where('created_at', '<=', $final)
                                   ->orderBy('created_at', 'asc')
                                   ->get();
            $start = $bonuslists->first()->created_at;
            $amount = $bonuslists->sum('amount');
            $data = [
                'member_id'      => $member_id,
                'amount'         => $amount,
                'date_since'     => $start,
                'date_finish'    => $final,
                'process_status' => BonusStatus::Checked,
            ];
            Bonus::create($data);
            foreach($bonuslists as $blist) {
                $blist->process_status = BonusStatus::Checked;
                $blist->save();
            }
        }
        return redirect()->route('bonus.index');
    }

}
