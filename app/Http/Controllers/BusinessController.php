<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Middleware\ImageUpload;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = Business::leftJoin('projects', 'proj_id', 'projects.id')
                                ->select('businesses.*', 'projects.name as project')
                                ->latest()->paginate(5);

        return view('businesses.index', compact('businesses'))
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

        return view('businesses.create', compact('projects'));
    }

    public function create2(Project $project)
    {
        $business = new Business;

        return view('businesses.create2', compact('business'))
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
            'status'       => 'required',
        ]);

        $business = new Business;

        $business->proj_id  = $request->proj_id;
        $business->link_url = $request->link_url;
        $business->status   = $request->status;

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $business->logo_url = $file->file_path;
        }
        $business->save();

        return redirect()->route('businesses.index')
                        ->with('success','Business Logo created successfully');
    }

    public function store2(Request $request, Project $project, Business $business)
    {
        $request->validate([
            'proj_id'      => 'required',
            'status'       => 'required',
        ]);

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $request->merge(['logo_url', $file->file_path]);
        }

        $request->merge(['proj_id', $project->id]);

        if ($business->id > 0) {
            $business->update($request->all());
        } else {
            Business::create($request->all());
        }

        return redirect()->route('frontend_views.edit', compact('project'))
                        ->with('success','Material created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        $id = $business->id;
        $business = Business::leftJoin('projects', 'proj_id', 'projects.id')
                            ->select('businesses.*', 'projects.name as project')
                            ->where('businesses.id', $id)->first();

        return view('businesses.show', compact('business'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        $projects = Project::where('status', true)->get();

        return view('businesses.edit', compact('business'))
               ->with(compact('projects'));
    }

    public function edit2(Project $project)
    {
        $business = Business::where('status', true)
                            ->where('proj_id', $project->id)
                            ->orderBy('updated_at', 'desc')
                            ->first();

        if ($business == null) {
            return $this->create2($project);
        }

        return view('businesses.edit2', compact('business'))
               ->with(compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
       $request->validate([
            'proj_id'      => 'required',
            'status'       => 'required',
        ]);

        $business->proj_id  = $request->proj_id;
        $business->link_url = $request->link_url;
        $business->status   = $request->status;

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $business->logo_url = $file->file_path;
        }
        $business->save();

        return redirect()->route('businesses.index')
                        ->with('success','Business Logo created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        $business->delete();

        return redirect()->route('businesses.index')
                        ->with('success','Business Logo deleted successfully');
    }

    public function query(Request $request)
    {

    }

}
