<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\Product;
use App\Models\File;
use App\Models\Startpage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StartpageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function newstore(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $insertflag = false;
        $startpage = Startpage::where('proj_id', '=', $id)->first();
        if ($startpage == null) {
            $startpage = new Startpage;
            $insertflag = true;
        }

        $startpage->proj_id = $id;
        $startpage->name = $request->name;
        $startpage->mime_type = $request->mime_type;
        if ($request->url != null) $startpage->url = $request->url;
        $startpage->detail = $request->detail;
        $startpage->status = $request->status;
        $startpage->start_datetime= $request->start_datetime;
        $startpage->stop_datetime = $request->stop_datetime;

        if ($request->mime_type == 'image') {
            if ($insertflag || $request->file()) {
                $file = ImageUpload::fileUpload($request);

                if ($file == null) {
                    return back()->with('image', $fileName);
                }
                $startpage->url = $file->file_path;
            }
        }

        $startpage->save();

        if ( $id == null ) {
            return redirect()->route('projects.index')
                        ->with('success','Startpage created successfully.');
        } else {
            $project = DB::table('projects')->where("id", $id)->first();

            return redirect()->route('projects.index', $id)->with('success', 'Startpage created successfully.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function show(Startpage $startpage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function edit(Startpage $startpage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Startpage $startpage)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'status' => 'required',
        ]);

        $file = ImageUpload::fileUpload($request);

        if ($file == null) {
            return back()->with('image', $fileName);
        } else {
            $startpage = new Startpage;
            $startpage->proj_id = ($id == 0) ? $request->proj_id : $id;
            $startpage->name = $request->name;
            $startpage->mime_type = $request->mime_type;
            $startpage->detail = $request->detail;
            $startpage->url = $file->file_path;
            $startpage->status = $request->status;
            $startpage->start_datetime= $request->start_datetime;
            $startpage->stop_datetime = $request->stop_datetime;
            $startpage->save();
        }

        if ( $id == null ) {
            return redirect()->route('projects.index')
                        ->with('success','Startpage created successfully.');
        } else {
            $project = DB::table('projects')->where("id", $id)->first();

            return redirect()->route('projects.index', $id)->with('success', 'Startpage created successfully.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Startpage $startpage)
    {
        //
    }

    public function query(Request $request)
    {
        if ($request->input('mac')) {
            $mac = str_replace(':', '', $request->input('mac'));
            $mac = strtoupper($mac);
            $product = Product::where('mac_address', '=', $mac)->firstOrFail();
            //var_dump($product);
            if ($product) {
                $proj_id = $product->proj_id;
            }
        } else if ($request->input('id')) {
            $proj_id = $request->input('id');
        }

        $startpage = Startpage::where('proj_id', $proj_id)->latest()->get()->first();
        if ($startpage)
            return json_encode($startpage);
    }

}
