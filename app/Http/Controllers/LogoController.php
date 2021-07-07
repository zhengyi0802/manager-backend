<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Middleware\ImageUpload;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logos = Logo::leftJoin('projects', 'proj_id', 'projects.id')
                       ->select('logos.*', 'projects.name as project')
                       ->latest()->paginate(5);

        return view('logos.index', compact('logos'))
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

        return view('logos.create', compact('projects'));
    }

    public function create2(Project $project)
    {
        $logo = new Logo;
        $logo->id = 0;

        return view('logos.create2', compact('logo'))
               ->with(compact('project'));
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
            'name'         => 'required',
            'status'       => 'required',
        ]);

        $logo = new Logo;

        $logo->proj_id     = $request->proj_id;
        $logo->name        = $request->name;
        $logo->description = $request->description;
        $logo->link_url    = $request->link_url;
        $logo->status      = $request->status;

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $logo->image = $file->file_path;
        }
        $logo->save();

        return redirect()->route('logos.index')
                        ->with('success','Logo created successfully');
    }

    public function store2(Request $request, Project $project, Logo $logo)
    {
        $request->validate([
            'name'         => 'required',
            'status'       => 'required',
        ]);

        $data = $request->all();
        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $data['image'] = $file->file_path;
        }

        $data['proj_id'] = $project->id;

        if ($logo->id > 0) {
            $logo->update($data);
        } else {
            Logo::create($data);
        }

        return redirect()->route('frontend_views.edit', compact('project'))
                        ->with('success','Logo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show(Logo $logo)
    {
        $id = $logo->id;
        $logo = Logo::leftJoin('projects', 'proj_id', 'projects.id')
                      ->select('logos.*', 'projects.name as project')
                      ->where('logos.id', $id)->first();

        return view('logos.show', compact('logo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logo $logo)
    {
        $projects = Project::where('status', true)->get();

        return view('logos.edit', compact('logo'))
               ->with(compact('projects'));
    }

    public function edit2(Project $project, Logo $logo)
    {
        $logo = Logo::where('proj_id', $project->id)
                    ->orderBy('updated_at', 'desc')
                    ->first();

        //echo $project->id."<br>";
        if ($logo == null) {
            return $this->create2($project);
        }

        return view('logos.edit2', compact('logo'))
               ->with(compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logo $logo)
    {
       $request->validate([
            'proj_id'      => 'required',
            'status'       => 'required',
        ]);

        $logo->proj_id     = $request->proj_id;
        $logo->name        = $request->name;
        $logo->description = $logo->description;
        $logo->link_url    = $request->link_url;
        $logo->status      = $request->status;

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $logo->image = $file->file_path;
        }
        $logo->save();

        return redirect()->route('logos.index')
                        ->with('success','Logo created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logo $logo)
    {
        $logo->delete();

        return redirect()->route('logos.index')
                        ->with('success','Logo deleted successfully');
    }

    public function query(Request $request)
    {

    }

}
