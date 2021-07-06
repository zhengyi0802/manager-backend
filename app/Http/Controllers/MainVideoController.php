<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\MainVideo;
use Illuminate\Http\Request;

class MainVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainvideos = MainVideo::leftJoin('projects', 'proj_id', 'projects.id')
                             ->select('main_videos.*', 'projects.name as project')
                             ->latest()->paginate(5);
        return view('mainvideos.index', compact('mainvideos'))
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

        return view('mainvideos.create', compact('projects'));
    }

    public function create2(Project $project)
    {
        $mainvideo = new MainVideo;

        return view('mainvideos.create2', compact('mainvideo'))
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
            'playlist'     => 'required',
            'status'       => 'required',
        ]);

        MainVideo::create($request->all());

        return redirect()->route('mainvideos.index')
                        ->with('success','Main Video created successfully');
    }

    public function store2(Request $request, Project $project, MainVideo $mainvideo)
    {
        if ($mainvideo > 0) {
            return $this->update($request, $mainvideo);
        } else {
            return $THIS->store($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainVideo  $mainVideo
     * @return \Illuminate\Http\Response
     */
    public function show(MainVideo $mainvideo)
    {
        $id = $mainvideo->id;
        $mainvideo = MainVideo::leftJoin('projects', 'proj_id', 'projects.id')
                              ->select('main_videos.*', 'projects.name as project')
                              ->where('main_videos.id', $id)->first();

        return view('mainvideos.show', compact('mainvideo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainVideo  $mainVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(MainVideo $mainvideo)
    {
        $projects = Project::where('status', true)->get();

        return view('mainvideos.edit', compact('mainvideo'))
                 ->with(compact('projects'));
    }

    public function edit2(Project $project)
    {
        $mainvideo = MainVideo::where('proj_id', $project->id)
                                ->orderBy('updated_at', 'desc')
                                ->first();
        if ($mainvideo == null) {
            return $this->create2($project);
        }

        return view('mainvideos.edit2', compact('mainvideo'))
               ->with(compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainVideo  $mainVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainVideo $mainvideo)
    {
        $request->validate([
            'proj_id'      => 'required',
            'playlist'     => 'required',
            'status'       => 'required',
        ]);

        $mainvideo->update($request->all());

        return redirect()->route('mainvideos.index')
                        ->with('success','Main Video updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainVideo  $mainVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainVideo $mainvideo)
    {
        $mainvideo->delete();

        return redirect()->route('mainvideos.index')
                        ->with('success','Main Video deleted successfully');
    }

    public function query(Request $request)
    {

    }

}
