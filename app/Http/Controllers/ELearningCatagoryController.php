<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\ELearningCatagory;
use App\Models\Project;
use App\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ELearningCatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elearningcatagories = ELearningCatagory::leftJoin('projects', 'proj_id', '=', 'projects.id')
                       ->select('e_learning_catagories.*', 'projects.name as proj_name')->paginate(5);

        return view('elearningcatagories.index',compact('elearningcatagories'))
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

        return view('elearningcatagories.create', compact('projects'));
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
            'proj_id'  => 'required',
            'name'     => 'required',
            'status'   => 'required',
        ]);

        $elearningcatagory = new ELearningCatagory;

        $elearningcatagory->proj_id     = $request->proj_id;
        $elearningcatagory->name        = $request->name;
        $elearningcatagory->description = $request->description;
        $elearningcatagory->status      = $request->status;

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $elearningcatagory->preview = $file->file_path;
        }

        $elearningcatagory->save();

        return redirect()->route('elearningcatagories.index')
                        ->with('success','ELearningCatagory created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ELearningCatagory  $eLearningCatagory
     * @return \Illuminate\Http\Response
     */
    public function show(ELearningCatagory $elearningcatagory)
    {
        $id = $elearningcatagory->id;
        $elearningcatagory = DB::table('e_learning_catagories')
                        ->leftJoin('projects', 'proj_id', 'projects.id')
                        ->select('e_learning_catagories.*', 'projects.name as proj_name')
                        ->where('e_learning_catagories.id', $id)->first();

        return view('elearningcatagories.show', compact('elearningcatagory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ELearningCatagory  $eLearningCatagory
     * @return \Illuminate\Http\Response
     */
    public function edit(ELearningCatagory $elearningcatagory)
    {
        $projects = Project::get();

        return view('elearningcatagories.edit', compact('elearningcatagory'))
               ->with(compact('projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ELearningCatagory  $eLearningCatagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ELearningCatagory $elearningcatagory)
    {
        $request->validate([
            'proj_id'  => 'required',
            'name'     => 'required',
            'status'   => 'required',
        ]);

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $request->merge(['preview',  $file->file_path]);
        }

        $elearningcatagory->update($request->all());

        return redirect()->route('elearningcatagories.index')
                        ->with('success','ELearningCatagory created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ELearningCatagory  $eLearningCatagory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ELearningCatagory $elearningcatagory)
    {
        $elearningcatagory->delete();

        return redirect()->route('elearningcatagories.index')
                        ->with('success', 'ELearningCatagory deleted successfully');
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
            }
        } else if ($request->input('id')) {
            $proj_id = $request->input('id');
        }

        $elearningcatagories = ELearningCatagory::where('proj_id', $proj_id)
                               ->where('status', true)
                               ->get();

        //var_dump($elearningcatagories);

        if ($elearningcatagories != null)
            return json_encode($elearningcatagories);

    }

}
