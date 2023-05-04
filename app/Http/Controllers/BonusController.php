<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Models\BonusList;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\BonusStatus;
use Illuminate\Http\Request;

class BonusController extends Controller
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
            $bonuses = Bonus::get();
        } else {
            $bonuses = Bonus::where('id', 1)->get();
        }
        return view('bonuses.index', compact('bonuses'));
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
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function show(Bonus $bonus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bonus $bonus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bonus $bonus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bonus $bonus)
    {
        //
    }

    public function transfered(Bonus $bonus)
    {
        $member_id = $bonus->member_id;
        $bonus->process_status  = BonusStatus::Transfered;
        $bonus->save();
        $bonuslists = BonusList::where('member_id', $member_id)
                               ->where('process_status', BonusStatus::Checked)
                               ->get();
        foreach($bonuslists as $bonuslist) {
            $bonuslist->process_status = BonusStatus::Transfered;
            $bonuslist->save();
        }
        return redirect()->route('bonuses.index');
    }
}
