<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //$managers = Manager::latest()->paginate(5);
       $managers = DB::table('managers')->leftJoin('users', 'user_id', '=', 'users.id')
                   ->select('managers.*', 'users.email as account')->paginate(5);

       return view('managers.index',compact('managers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('managers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'account'   => 'required',
            'password'  => 'required',
            'job_title' => 'required',
            'status'    => 'required',
        ]);

        $user           = new User;
        $user->name     = $request->name;
        $user->email    = $request->account;
        $user->password = Hash::make($request->password);
        $user->role     = 'manager';
        $user->save();

        $manager          = new Manager;
        $manager->name    = $request->name;
        $manager->user_id = $user->id;
        $manager->job_title = $request->job_title;
        $manager->description = $request->description;
        $manager->status = $request->status;
        $manager->save();

        return redirect()->route('managers.index')
                        ->with('success','Manager created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        $user = User::where('id', $manager->user_id)->first();

        return view('managers.show', compact('manager'))
               ->with('account', $user->email);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        $user = User::where('id', $manager->user_id)->first();

        return view('managers.edit', compact('manager'))
               ->with('account', $user->email);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        $request->validate([
            'name'      => 'required',
            'account'   => 'required',
            'password'  => 'required',
            'job_title' => 'required',
            'status'    => 'required',
        ]);

        $user = User::where('email', $request->account)->first();
        if ($user == null) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->account;
            $user->password = Hash::make($request->password);
            $user->role = 'manager';
            $user->save();
        }
        $manager->user_id     = $user->id;
        $manager->name        = $request->name;
        $manager->job_title   = $request->job_title;
        $manager->description = $request->description;
        $manager->status      = $request->status;
        $manager->save();

        return redirect()->route('managers.index')
                        ->with('success','Manager created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        $user = User::where('id', $manager->user_id)->first();
        $manager->delete();
        $user->delete();

        return redirect()->route('managers.index')
                        ->with('success','Project deleted successfully');
    }
}
