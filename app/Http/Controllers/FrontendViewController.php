<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Product;
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
        $projects = Project::where('status', true)->get();
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
        //var_dump($frontend_view);
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

    public function getQuery($id)
    {
        $block_name = [
                        '1'  => 'logo',
                        '2'  => null,
                        '3'  => null,
                        '4'  => 'customLogo',
                        '5'  => 'videos',
                        '6'  => 'bulletin',
                        '7'  => 'Ad',
                        '8'  => 'app1',
                        '9'  => 'app2',
                        '10' => 'app3',
                        '11' => 'app4',
                        '12' => 'app5',
                        '13' => 'app6',
                        '14' => 'app7',
                        '15' => 'app8',
                        '16' => 'app9',
        ];

        $materials = [];
        for ($i = 1; $i < 17; $i++) {
           $blocks = Material::where('proj_id', $id)->where('position', $i)->where('status', true)->get();
           if ($block_name[$i] != null) $materials += [ $block_name[$i] => $blocks->toArray()];
        }

        return $materials;
    }

    public function getMaterials($id) {
        $materials = [];
        for ($i=1; $i < 19; $i++) {
           $block = Material::where('proj_id', $id)->where('position', $i)->where('status', true)->where('prev_id', '0')->first();
           $materials += ['block'.$i => $block];
        }

        return $materials;
    }

    public function query(Request $request) {
        if ($request->input('mac')) {
            $mac = str_replace(':', '', $request->input('mac'));
            $mac = strtoupper($mac);
            $product = Product::where('ether_mac', '=', $mac)->firstOrFail();
            //var_dump($product);
            if ($product) {
                $proj_id = $product->proj_id;
            }
        } else if ($request->input('id')) {
            $proj_id = $request->input('id');
        }

        $data = $this->getQuery($proj_id);
        if ($data)
            return json_encode($data);

    }


}
