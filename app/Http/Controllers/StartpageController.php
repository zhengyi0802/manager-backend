<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\Project;
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
        $startpages = Startpage::leftJoin('projects', 'proj_id', '=', 'projects.id')
                       ->select('startpages.*', 'projects.name as proj_name')->paginate(5);

        return view('startpages.index',compact('startpages'))
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

        return view('startpages.create', compact('projects'));
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
            'proj_id' => 'required',
            'mime_type' => 'required',
            'status' => 'required',
        ]);

        $startpage = new Startpage;

        $startpage->name = $request->name;
        $startpage->proj_id = $request->proj_id;
        $startpage->mime_type = $request->mime_type;
        $startpage->url = $request->url;
        $startpage->status = $request->status;

        if ($request->mime_type == 'image') {
           if ($request->file()) {
               $file = ImageUpload::fileUpload($request);
               if ($file == null) {
                   return back()->with('image', $fileName);
               }
               $startpage->url = $file->file_path;
           }
        }

        $startpage->save();

        return redirect()->route('startpages.index')
                        ->with('success','Startpage created successfully.');

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
        $project = Project::where('id', '=', $startpage->proj_id)->first();
        return view('startpages.show', compact('startpage'))
               ->with(compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function edit(Startpage $startpage)
    {
        $project = Project::where('id', '=', $startpage->proj_id)->first();
        return view('startpages.edit', compact('startpage'))
               ->with(compact('project'));
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
            'mime_type' => 'required',
            'status' => 'required',
        ]);

        if($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $startpage->merge(['url',  $file->file_path]);
        }

        $startpage->update($request->all());

        return redirect()->route('startpages.index', $id)->with('success', 'Startpage created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Startpage $startpage)
    {
        $startpage->delete();

        return redirect()->route('startpages.index')
                        ->with('success','Start Page deleted successfully');
    }

    public function query(Request $request)
    {
        if ($request->input('mac')) {
            $mac = str_replace(':', '', $request->input('mac'));
            $mac = strtoupper($mac);
            $product = Product::where('ether_mac', '=', $mac)->firstOrFail();
            //var_dump($product);
            if ($product) {
                $proj_id = $product->proj_id;
                //var_dump($proj_id);
            }
        } else if ($request->input('id')) {
            $proj_id = $request->input('id');
        }

        $datetime = date('y-m-d h:i:s');
        $startpage = Startpage::where('proj_id', $proj_id)
                               ->where('status', true)
                               ->orderBy('id', 'desc')
                               ->first();
        if ($startpage) {
            $result = array(
                    'name'        => $startpage->name,
                    'mime_type'   => $startpage->mime_type,
                    'url'         => $startpage->url,
                    'start_time'  => $startpage->start_time,
                    'stop_time'    => $startpage->stop_time,
            );
            return json_encode($result);
        }
    }

}
