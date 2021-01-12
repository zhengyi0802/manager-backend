<?php

namespace App\Http\Controllers;

use App\Models\ProductCatagory;
use Illuminate\Http\Request;

class ProductCatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCatagories = ProductCatagory::latest()->paginate(5);

        return view('product_catagories.index',compact('productCatagories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product_catagories.create');
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
        ]);

        ProductCatagory::create($request->all());

        return redirect()->route('product_catagories.index')
                        ->with('success','Product Catagories created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCatagory  $productCatagory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCatagory $productCatagory)
    {
        return view('product_catagories.show', compact('productCatagory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCatagory  $productCatagory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCatagory $productCatagory)
    {
        return view('product_catagories.edit', compact('productCatagory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCatagory  $productCatagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCatagory $productCatagory)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $productCatagory->update($request->all());

        return redirect()->route('product_catagories.index')
                        ->with('success','Product Catagory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCatagory  $productCatagory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCatagory $productCatagory)
    {
        $productCatagory->delete();

        return redirect()->route('product_catagories.index')
                        ->with('success','Product Catagory deleted successfully');
    }
}
