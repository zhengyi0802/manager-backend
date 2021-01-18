<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Material;
use Illuminate\Http\Request;

class FrontendViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::get();
        return view('frontend_views.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend_views.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view('frontend_views.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FrontendView  $frontendView
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('frontend_views.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FrontendView  $frontendView
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        if ($project->id == 0) $this->index();
        $frontend_view = $this->getMaterials($project->id);

        return view('frontend_views.edit', compact('project'))
               ->with(compact('frontend_view'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FrontendView  $frontendView
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        return view('frontend_views.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FrontendView  $frontendView
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        return view('frontend_views.index');
    }

    public function getMaterials($id)
    {
        $materials = [];
        for ($i = 1; $i < 19; $i++) {
           $block = Material::where('proj_id', $id)->where('position', $i)->where('status', true)->where('prev_id', '0')->first();
           $materials += ['block'.$i => $block];
        }

        return $materials;
    }

    public function getQuery($id) {
        $materials = [];
        for ($i=1; $i < 19; $i++) {
           $blocks = Material::where('proj_id', $id)->where('position', $i)->where('statu', true)->get();
           if ($blocks != null) {
               $materials += ['block].$i => $blocks];
           }
        }

        return $materials;
    }

    public function query() {
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

        $data = $this->getQuery($proj_id);
        if ($data)
            return json_encode($startpage);

    }

}
