<?php
namespace App\Http\Controllers;

use Hash;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$resellers = Reseller::latest()->paginate(5);
        $resellers = DB::table('sales')->paginate(5);

        return view('sales.index',compact('sales'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.create');
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
            'company'  => 'required',
            'account'  => 'required',
            'password' => 'required',
            'contact'  => 'required',
            'cotype'   => 'required',
            'zipcode'  => 'required',
            'address'  => 'required',
            'phones'   => 'required',
            'status'   => 'required',
        ]);

        //Reseller::create($request->all());
        $user = new User;
        $user->name = $request->contact;
        $user->email = $request->account;
        $user->password = Hash::make($request->password);
        $user->role = "reseller";
        $user->save();

        $reseller = new Reseller;
        $reseller->company = $request->company;
        $reseller->user_id = $user->id;
        $reseller->contact = $request->contact;
        $reseller->cotype  = $request->cotype;
        $reseller->zipcode = $request->zipcode;
        $reseller->address = $request->address;
        $reseller->status  = $request->status;
        $reseller->phones  = $request->phones;
        $reseller->save();

        return redirect()->route('resellers.index')
                        ->with('success','Reseller created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        return view('sales.show', compact('sales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {
        return view('sales.edit', compact('sales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reseller $reseller)
    {
        $request->validate([
            'company'  => 'required',
            'account'  => 'required',
            'password' => 'required',
            'contact'  => 'required',
            'cotype'   => 'required',
            'zipcode'  => 'required',
            'address'  => 'required',
            'phones'   => 'required',
            'status'   => 'required',
        ]);

        //Reseller::update($request->all());
        $user = User::where('id', $request->user_id)->first();
        if ($user == null) {
            $user           = new User;
            $user->name     = $request->contact;
            $user->email    = $request->account;
            $user->password = Hash::make($request->password);
            $user->role     = "reseller";
            $user->save();
        }

        $reseller->user_id  = $user->id;
        $reseller->company  = $request->company;
        $reseller->contact  = $request->contact;
        $reseller->cotype   = $request->cotype;
        $reseller->zipcode  = $request->zipcode;
        $reseller->address  = $request->address;
        $reseller->status   = $request->status;
        $reseller->save();

        return redirect()->route('resellers.index')
                        ->with('success','Reseller created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales)
    {
        $sales->delete();

        return redirect()->route('saless.index')
                        ->with('success','Sales deleted successfully');
    }
}
