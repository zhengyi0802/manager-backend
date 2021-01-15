<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Models\ProductStatus;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
                        ->leftJoin('product_types', 'type_id', 'product_types.id')
                        ->leftJoin('projects', 'proj_id', 'projects.id')
                        ->leftJoin('product_statuses', 'status_id', 'product_statuses.id')
                        ->select('products.*', 'product_types.name as type_name',
                          'projects.name as project_name',
                          'product_statuses.name as status_name')->paginate(5);
        if ($products) {
            foreach($products as $product) {
                $mac_array = str_split($product->mac_address, 2);
                $macaddress = implode(':', $mac_array);
                $product->mac_address = $macaddress;
            }
        }
        return view('products.index',compact('products'))
              ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productTypes = DB::table('product_types')->get();
        $productStatuses = DB::table('product_statuses')->get();
        $projects = DB::table('projects')->get();

        return view('products.create', compact('productTypes'))
               ->with(compact('productStatuses'))
               ->with(compact('projects'));
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
            'serialno' => 'required',
            'type_id' => 'required',
            'mac_address' => 'required',
            'status_id' => 'required',
        ]);

        $mac = str_replace(":", "", $request->input('mac_address'));
        $mac = strtoupper($mac);
        $request->merge(array('mac_address' => $mac));

        Product::create($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $productType = ProductType::where('id', $product->type_id)->first();
        $productStatus = ProductStatus::where('id', $product->status_id)->first();
        $project = Project::where('id', $product->proj_id)->first();
        $proj_name = ($project != null) ? $project->name : '--------';
        $mac_array = str_split($product->mac_address, 2);
        $mac_address = implode(':', $mac_array);
        $product->mac_address = $mac_address;

        return view('products.show',compact('product'))
               ->with('proj_name', $proj_name)
               ->with('type_name', $productType->name)
               ->with('status_name', $productStatus->name);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productTypes = DB::table('product_types')->get();
        $productStatuses = DB::table('product_statuses')->get();
        $projects = DB:: table('projects')->get();
        $mac_array = str_split($product->mac_address, 2);
        $mac_address = implode(':', $mac_array);
        $product->mac_address = $mac_address;

        return view('products.edit', compact('product'))
               ->with(compact('productTypes'))
               ->with(compact('projects'))
               ->with(compact('productStatuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'serialno' => 'required',
            'mac_address' => 'required',
            'type_id' => 'required',
            'status_id' => 'required',
        ]);

        $mac = str_replace(":", "", $request->input('mac_address'));
        $mac = strtoupper($mac);
        $request->merge(array('mac_address' => $mac));

        $product->update($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
