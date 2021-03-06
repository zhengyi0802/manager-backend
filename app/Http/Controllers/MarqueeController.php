<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Product;
use App\Models\Marquee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MarqueeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marquees = DB::table('marquees')
                        ->leftJoin('projects', 'proj_id', 'projects.id')
                        ->leftJoin('products', 'product_id', 'products.id')
                        ->select('marquees.*', 'products.serialno as serialno',
                          'projects.name as project_name')->paginate(5);

        return view('marquees.index', compact('marquees'))
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
        $products = Product::get();

        return view('marquees.create', compact('projects'))
               ->with(compact('products'));
        //return view('marquees.create', compact('projects'));
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
            'type'     => 'required',
            'name'     => 'required',
            'content'  => 'required',
        ]);

        Marquee::create($request->all());

        return redirect()->route('marquees.index')
                        ->with('success','Marquee created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function show(Marquee $marquee)
    {
        $id = $marquee->id;
        $marquee = DB::table('marquees')
                        ->leftJoin('projects', 'proj_id', 'projects.id')
                        ->leftJoin('products', 'product_id', 'products.id')
                        ->select('marquees.*', 'products.serialno as serialno',
                          'projects.name as project_name')->where('marquees.id', $id)->first();

        return view('marquees.show', compact('marquee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function edit(Marquee $marquee)
    {
        $projects = Project::where('status', true)
                           ->get();
        $products = Product::get();
        $marquees = Marquee::where('proj_id', $marquee->proj_id)
                           ->get();

        return view('marquees.edit', compact('marquee'))
               ->with(compact('projects'))
               ->with(compact('products'))
               ->with(compact('marquees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marquee $marquee)
    {
        $request->validate([
            'type'     => 'required',
            'name'     => 'required',
            'content'  => 'required',
        ]);

        $marquee->update($request->all());

        return redirect()->route('marquees.index')
                        ->with('success','Marquee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marquee $marquee)
    {
        $marquee->delete();

        return redirect()->route('marquees.index')
                        ->with('success','Marquee deleted successfully');
    }

    public function query(Request $request)
    {
        if ($request->input('mac')) {
            $mac = str_replace(':', '', $request->input('mac'));
            $mac = strtoupper($mac);
            $product = Product::where('ether_mac', '=', $mac)
                              ->orWhere('wifi_mac', '=', $mac)
                              ->first();

            if ($product) {
                $proj_id = $product->proj_id;
            } else {
                return json_encode(array());
           }
        } else if ($request->input('id')) {
            $proj_id = $request->input('id');
            $product = Product::where('proj_id', $proj_id)->first();
        }

        if ($request->input('type')) {
            $type = $request->input('type');
            if ($type == 1) {
               if ($product == null) {
                   return json_encode(array());
               }
               $marquees = Marquee::select('type', 'name', 'content', 'url')
                                  ->where('product_id', $product->id)
                                  ->where('status', true)
                                  ->where('type', $type)
                                  ->get();
            } else if ($type == 2 || $type == 3) {
               $marquees = Marquee::select('type', 'name', 'content', 'url' )
                                  ->where('status', true)
                                  ->where('type', $type)
                                  ->get();
            }
        } else {
            $marquees = Marquee::select('type', 'name', 'content', 'url')
                        ->where('proj_id', $proj_id)
                        ->where('status', true)
                        ->orderBy('type', 'asc')
                        ->get();
        }
        //var_dump($marquees);

        $result = null;
        if ($marquees) {
            $result = $marquees->toArray();
        }

        return json_encode($result);
    }

}
