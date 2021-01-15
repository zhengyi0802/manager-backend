<?php

namespace App\Http\Controllers;

use App\Models\ProductStatus;
use Illuminate\Http\Request;

class ProductStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productStatuses = ProductStatus::latest()->paginate(5);

        return view('product_statuses.index',compact('productStatuses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product_statuses.create');
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

        ProductStatus::create($request->all());

        return redirect()->route('product_statuses.index')
                        ->with('success','Product Status created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductStatus  $productStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ProductStatus $productStatus)
    {
        return view('product_statuses.show', compact('productStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductStatus  $productStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductStatus $productStatus)
    {
        return view('product_statuses.edit', compact('productStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductStatus  $productStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductStatus $productStatus)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $productStatus->update($request->all());

        return redirect()->route('product_statuses.index')
                        ->with('success','Product Status updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductStatus  $productStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductStatus $productStatus)
    {
        $productStatus->delete();

        return redirect()->route('product_statuses.index')
                        ->with('success','Product Status deleted successfully');
    }
}
