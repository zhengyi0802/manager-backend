<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = Manager::get();

        return view('managers.index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('managers.create')->with('message', '');
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
        $check_user = User::where('line_id', $data['line_id'])
                          ->orWhere('phone', $data['phone'])
                          ->get();
        if ($check_user != null && count($check_user)) {
            return view('managers.create')->with('message','error');
        }

        $creator = auth()->user();
        $data['created_by'] = $creator->id;
        $user = [
            'name'       => $data['name'],
            'phone'      => $data['phone'],
            'line_id'    => $data['line_id'],
            'password'   => bcrypt($data['password']),
            'role'       => UserRole::Manager,
            'created_by' => $creator->id,
            'status'     => true,
        ];
        $user = User::create($user);
        $data['user_id'] = $user->id;

        Manager::create($data);
        return redirect()->route('managers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        return view('managers.show', compact('manager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        return view('managers.edit', compact('manager'));
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
        $data = $request->all();
        $creator = auth()->user();
        $data['created_by'] = $creator->id;
        $manager->update($data);
        $user = User::find($manager->user_id);
        $user->phone = $data['phone'];
        $user->line_id = $data['line_id'];
        if ($data['password'] != null) {
            $user->password = bcrypt($data['password']);
            $user->role = UserRole::Manager;
        }
        $user->save();

        return redirect()->route('managers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        $manager->status = false;
        $manager->save();

        return redirect()->route('managers.index');
    }
}
