<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Models\ProductCatagory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productTypes = DB::table('product_types')->leftJoin('product_catagories', 'catagory_id', 'product_catagories.id')
                        ->select('product_types.*', 'product_catagories.name as catagory_name')->paginate(5);

        return view('product_types.index',compact('productTypes'))
              ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCatagories = DB::table('product_catagories')->get();

        return view('product_types.create', compact('productCatagories'));
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
            'name' => 'required',
            'catagory_id' => 'required',
            'status' => 'required',
        ]);

        ProductType::create($request->all());

        return redirect()->route('product_types.index')
                        ->with('success','Product Types created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        $productCatagory = ProductCatagory::where('id', $productType->catagory_id)->first();

        return view('product_types.show',compact('productType'))
               ->with('catagory_name', $productCatagory->name);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        $productCatagories = DB::table('product_catagories')->get();

        return view('product_types.edit', compact('productType'), compact('productCatagories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        $request->validate([
            'name' => 'required',
            'catagory_id' => 'required',
            'status' => 'required',
        ]);

        $productType->update($request->all());

        return redirect()->route('product_types.index')
                        ->with('success','Product Types created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        $productType->delete();

        return redirect()->route('product_types.index')
                        ->with('success','Product Type deleted successfully');
    }
}
