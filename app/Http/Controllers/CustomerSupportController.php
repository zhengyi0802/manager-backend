<?php

namespace App\Http\Controllers;

use App\Models\CustomerSupport;
use App\Models\Project;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomerSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customersupports = CustomerSupport::leftJoin('projects', 'proj_id', 'projects.id')
                           ->select('customer_supports.*', 'projects.name as project')
                           ->latest()->paginate(5);

       return view('customersupports.index', compact('customersupports'))
               ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::where('status', true)->get();

        return view('customersupports.create', compact('projects'));
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
            'proj_id'      => 'required',
            'qrcode_type'  => 'required',
            'rcapp'        => 'required',
            'status'       => 'required',
        ]);

        CustomerSupport::create($request->all());

        return redirect()->route('customersupports.index')
                        ->with('success','CustomerSupport created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerSupport  $customerSupport
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerSupport $customersupport)
    {
        $id = $customersupport->id;
        $customersupport = CustomerSupport::leftJoin('projects', 'proj_id', 'projects.id')
                           ->select('customer_supports.*', 'projects.name as project')
                           ->where("customer_supports.id", $id)->first();

        return view('customersupports.show', compact('customersupport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerSupport  $customerSupport
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerSupport $customersupport)
    {
        $projects = Project::where('status', true)->get();

        return view('customersupports.edit', compact('customersupport'))
               ->with(compact('projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerSupport  $customerSupport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerSupport $customersupport)
    {
        $request->validate([
            'proj_id'      => 'required',
            'qrcode_type'  => 'required',
            'rcapp'        => 'required',
            'status'       => 'required',
        ]);

        $customersupport->update($request->all());

        return redirect()->route('customersupports.index')
                        ->with('success','CustomerSupport created successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerSupport  $customerSupport
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerSupport $customersupport)
    {
        $customersdupport->delete();

        return redirect()->route('customersupports.index')
                        ->with('success','CustomerSupport deleted successfully');
    }

    public function query(Request $request)
    {
        if ($request->input('mac')) {
            $mac = str_replace(':', '', $request->input('mac'));
            $mac = strtoupper($mac);
            $product = Product::where('ether_mac', '=', $mac)
                              ->orWhere('wifi_mac', '=', $mac)
                              ->firstOrFail();

            if ($product) {
                $proj_id = $product->proj_id;
                //var_dump($proj_id);
            }
        } else if ($request->input('id')) {
            $proj_id = $request->input('id');
        }

        $customersupport = CustomerSupport::where('proj_id', $proj_id)->where('status', true)->first();
        if ($customersupport)
            return json_encode($customersupport);

    }

}
