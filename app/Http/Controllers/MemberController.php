<?php
namespace App\Http\Controllers;

use Hash;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //$members = Member::latest()->paginate(5);
       $members = DB::table('members')->leftJoin('users', 'user_id', '=', 'users.id')
                   ->select('members.*', 'users.email as account')->paginate(5);

       return view('members.index',compact('members'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        $request->validate([
            'name'     => 'required',
            'account'  => 'required',
            'password' => 'required',
            'zipcode'  => 'required',
            'address'  => 'required',
            'phones'   => 'required',
            'status'   => 'required',
        ]);

        //Member::create($request->all());
        $user           = new User;
        $user->name     = $request->name;
        $user->email    = $request->account;
        $user->password = Hash::make($request->password);
        $user->role     = 'member';
        $user->save();

        $member          = new Member;
        $member->name    = $request->name;
        $member->user_id = $user->id;
        $member->zipcode = $request->zipcode;
        $member->address = $request->address;
        $member->phones  = $request->phones;
        $member->status  = $request->status;
        $member->save();

        return redirect()->route('members.index')
                        ->with('success','Member created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $user = User::where('id', $member->user_id)->first();

        return view('members.show', compact('member'))
               ->with('account', $user->email);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $user = User::where('id', $member->user_id)->first();

        return view('members.edit',compact('member'))
               ->with('account', $user->email);
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
        $request->validate([
            'name'     => 'required',
            'account'  => 'required',
            'password' => 'required',
            'zipcode'  => 'required',
            'address'  => 'required',
            'phones'   => 'required',
            'status'   => 'required',
        ]);

        //Member::create($request->all());
        $user = User::where('email', $request->user_id)->first();
        if ($user == null) {
            $user           = new User;
            $user->name     = $request->name;
            $user->email    = $request->account;
            $user->password = Hash::make($request->password);
            $user->role     = 'member';
            $user->save();
        }

        $member->user_id    = $user->id;
        $member->name       = $request->name;
        $member->zipcode    = $request->zipcode;
        $member->address    = $request->address;
        $member->phones     = $request->phones;
        $member->status     = $request->status;
        $member->save();

        return redirect()->route('members.index')
                        ->with('success','Member created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $user = User::where('id', $member->user_id)->first();
        $member->delete();
        $user->delete();

        return redirect()->route('members.index')
                        ->with('success','Member deleted successfully');

    }
}
