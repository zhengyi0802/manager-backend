<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\File;
use App\Models\Project;
use App\Models\Material;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = DB::table('materials')->leftJoin('projects', 'proj_id', '=', 'projects.id')
                 ->select('materials.*', 'projects.name as project_name')->paginate(5);

        return view('materials.index',compact('materials'))
              ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::get();
        $materials = Material::get();
        return view('materials.create')->with(compact('projects'))->with(compact('materials'));
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
                'name'      => 'required',
                'proj_id'   => 'required',
                'position'  => 'required',
                'prev_id'   => 'required',
                'status'    => 'required',
        ]);

        $material = new Material;

        $material->name = $request->name;
        $material->proj_id = $request->proj_id;
        $material->position = $request->position;
        $material->prev_id = $request->prev_id;
        $material->mime_type = $request->mime_type;
        $material->content = $request->content;
        $material->video_url = $request->video_url;
        $material->url_link = $request->url_link;
        $material->status = $request->status;

        if ($request->mime_type == 'image') {
           if ($request->file()) {
               $file = ImageUpload::fileUpload($request);
               if ($file == null) {
                   return back()->with('image', $fileName);
               }
               $material->image_url = $file->file_path;
           }
        }

        $material->save();

        return redirect()->route('materials.index')
                        ->with('success','Material created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        $project = Project::where('id', $material->proj_id)->first();
        $prev = null;
        if ($material->prev_id > 0) {
            $prev = Material::where('prev_id', $material->prev_id)->first();
        }
        return view('materials.show',compact('material'))
               ->with(compact('project'))->with('prev_name', $prev->name ?? '---------' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        $projects = Project::get();
        $materials = Material::get();

        return view('materials.edit',compact('material'))
               ->with(compact('projects'))
               ->with(compact('materials'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
                'name'      => 'required',
                'proj_id'   => 'required',
                'position'  => 'required',
                'prev_id'   => 'required',
                'mime_type' => 'required',
        ]);

        if ($request->mime_type == 'image') {
           if ($request->file()) {
               $file = ImageUpload::fileUpload($request);
               if ($file == null) {
                   return back()->with('image', $fileName);
               }
               $request->merge(['image_url' => $file->file_path]);
           }
        }

        $material->update($request->all());

        return redirect()->route('materials.index')
                        ->with('success','Material created successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materials.index')
                        ->with('success','Material deleted successfully');
    }
}
