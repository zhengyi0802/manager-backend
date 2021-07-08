<?php

namespace App\Http\Controllers;

use App\Models\QACatagory;
use Illuminate\Http\Request;

class QACatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $qacatagories = QACatagory::latest()->paginate(5);

        return view('qacatagories.index', compact('qacatagories'))
               ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('qacatagories.create');
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
            'status'   => 'required',
        ]);

        QACatagory::create($request->all());

        return redirect()->route('qacatagories.index')
                        ->with('success','QACatagory created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QACatagory  $qACatagory
     * @return \Illuminate\Http\Response
     */
    public function show(QACatagory $qacatagory)
    {
        return view('qacatagories.show', compact('qacatagory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QACatagory  $qACatagory
     * @return \Illuminate\Http\Response
     */
    public function edit(QACatagory $qacatagory)
    {
        return view('qacatagories.edit', compact('qacatagory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QACatagory  $qACatagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QACatagory $qacatagory)
    {
        $request->validate([
            'name'     => 'required',
            'status'   => 'required',
        ]);

        $qacatagory->update($request->all());

        return redirect()->route('qacatagories.index')
                        ->with('success','QACatagory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QACatagory  $qACatagory
     * @return \Illuminate\Http\Response
     */
    public function destroy(QACatagory $qacatagory)
    {
        $qacatagory->delete();

        return redirect()->route('qacatagories.index')
                        ->with('success', 'QACatagory deleted successfully');
    }

    public function query(Request $request)
    {
        $qacatagories = QACatagory::where('status', true)->get();


        if ($qacatagories != null)
            return json_encode($qacatagories);
    }

}
