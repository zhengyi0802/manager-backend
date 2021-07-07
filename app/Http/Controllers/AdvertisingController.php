<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Advertising;
use Illuminate\Http\Request;
use App\Http\Middleware\ImageUpload;

class AdvertisingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisings = Advertising::leftJoin('projects', 'proj_id', 'projects.id')
                                ->select('advertisings.*', 'projects.name as project')
                                ->latest()->paginate(5);

        return view('advertisings.index', compact('advertisings'))
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

        return view('advertisings.create', compact('projects'));
    }

    public function create2(Project $project)
    {
        $advertising = new Advertising;

        return view('advertisings.create2', compact('advertising'))
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
            'index'        => 'required',
            'status'       => 'required',
        ]);

        $advertising = new Advertising;

        $advertising->proj_id  = $request->proj_id;
        $advertising->index    = $request->index;
        $advertising->link_url = $request->link_url;
        $advertising->status   = $request->status;

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $advertising->thumbnail = $file->file_path;
        }
        $advertising->save();

        return redirect()->route('advertisings.index')
                        ->with('success','Advertising created successfully');

    }

    public function store2(Request $request, Project $project, Advertising $advertising)
    {
        $request->validate([
            'index'        => 'required',
            'status'       => 'required',
        ]);

        $data = $request->all();
        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $data['thumbnail'] = $file->file_path;
        } else {
            $data['thumbnail'] = $advertising->thumbnail;
        }

        $data['proj_id'] = $project->id;

        if ($advertising->id > 0) {
            $advertising->update($data);
        } else {
            Advertising::create($data);
        }

        return redirect()->route('frontend_views.edit', compact('project'))
                        ->with('success','Advertising created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function show(Advertising $advertising)
    {
        $id = $advertising->id;
        $advertising = Advertising::leftJoin('projects', 'proj_id', 'projects.id')
                                  ->select('advertisings.*', 'projects.name as project')
                                  ->where('advertisings.id', $id)->first();

        return view('advertisings.show', compact('advertising'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertising $advertising)
    {
        $projects = Project::where('status', true)->get();

        return view('advertisings.edit', compact('advertising'))
               ->with(compact('projects'));
    }

    public function edit2(Project $project)
    {
        $advertising = Advertising::where('proj_id', $project->id)
                            ->orderBy('updated_at', 'desc')
                            ->first();

        if ($advertising == null) {
            return $this->create2($project);
        }

        return view('advertisings.edit2', compact('advertising'))
               ->with(compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertising $advertising)
    {
       $request->validate([
            'proj_id'      => 'required',
            'status'       => 'required',
        ]);

        $advertising->proj_id  = $request->proj_id;
        $advertising->index    = $request->index;
        $advertising->link_url = $request->link_url;
        $advertising->status   = $request->status;

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $advertising->thumbnail = $file->file_path;
        }
        $advertising->save();

        return redirect()->route('advertisings.index')
                        ->with('success','Advertising created successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertising $advertising)
    {
        $advertising->delete();

        return redirect()->route('advertisings.index')
                        ->with('success','Advertising deleted successfully');
    }

    public function query(Request $request)
    {


    }

}
