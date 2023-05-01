<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class AccounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounters = User::where('role', UserRole::Accounter)->get();

        return view('accounters.index', compact('accounters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $creator = auth()->user();
        $data['created_by'] = $creator->id;
        $data['role'] = UserRole::Accounter;
        $data['password'] = bcrypt($data['password']);
        $data['status'] = true;
        try {
            User::create($data);
        } exception(Throwable $th) {
            return back()->with('error', 'user_create_error');
        }
        return redirect()->route('accounters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\accounter  $accounter
     * @return \Illuminate\Http\Response
     */
    public function show(User $accounter)
    {
        return view('accounters.show', compact('accounter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\accounter  $accounter
     * @return \Illuminate\Http\Response
     */
    public function edit(User $accounter)
    {
        return view('accounters.edit', compact('accounter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\accounter  $accounter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $accounter)
    {
        $data = $request->all();
        $creator = auth()->user();
        $data['created_by'] = $creator->id;
        $data['role'] = UserRole::Accounter;
        if ($data['new_password'] != null) {
            $data['password'] = bcrypt($data['new_password']);
        }
        $accounter->update($data);

        return redirect()->route('accounters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\accounter  $accounter
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $accounter)
    {
        $accounter->status = false;
        $accounter->save();

        return redirect()->route('accounters.index');
    }
}
