<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\ELearningCatagory;
use App\Models\ELearning;
use App\Models\Project;
use App\Models\Product;
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
        $elearningcatagories = DB::table('e_learning_catagories as a')
                        ->leftJoin('projects', 'a.proj_id', 'projects.id')
                        ->leftJoin('e_learning_catagories as b', 'a.parent_id', 'b.id')
                        ->select('a.*', 'b.name as parent', 'projects.name as project' )
                        ->paginate(5);

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
        $projects = Project::where('status', true)->get();
        $elearningcatagories = ELearningCatagory::where('status', true)->where('type', 'catagory')->get();

        return view('elearningcatagories.create', compact('projects'))
               ->with(compact('elearningcatagories'));
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
        $elearningcatagory->parent_id   = $request->parent_id;
        $elearningcatagory->type        = $request->type;
        $elearningcatagory->name        = $request->name;
        $elearningcatagory->description = $request->description;
        $elearningcatagory->status      = $request->status;

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $elearningcatagory->thumbnail = $file->file_path;
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
        $elearningcatagory = DB::table('e_learning_catagories as a')
                        ->leftJoin('projects', 'a.proj_id', 'projects.id')
                        ->leftJoin('e_learning_catagories as b', 'a.parent_id', 'b.id')
                        ->select('a.*', 'b.name as parent', 'projects.name as proj_name' )
                        ->where('a.id', $id)->first();
        $parent = "root";

        return view('elearningcatagories.show', compact('elearningcatagory'))
               ->with(compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ELearningCatagory  $eLearningCatagory
     * @return \Illuminate\Http\Response
     */
    public function edit(ELearningCatagory $elearningcatagory)
    {
        $projects = Project::where('status', true)->get();
        $elearningcatagories = ELearningCatagory::where('status', true)->where('type', 'catagory')->get();

        return view('elearningcatagories.edit', compact('elearningcatagory'))
               ->with(compact('projects'))
               ->with(compact('elearningcatagories'));
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
            $request->merge(['thumbnail',  $file->file_path]);
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

        $elearnings = ELearning::where('status', true)->get();
        $contents = array();
        foreach ($elearnings as $elearning) {
                $item = array(
                        'catagory_id' => $elearning->catagory_id,
                        'name'        => $elearning->name,
                        'description' => $elearning->description,
                        'type'        => $elearning->mime_type,
                        'url'         => $elearning->url,
                );
                array_push($contents, $item);
        }

        $elearningcatagories = ELearningCatagory::where('status', true)
                                  ->where('proj_id', $proj_id)
                                  ->orderBy('id', 'asc')
                                  ->get();

        $data = array();
        $data[0] = array(
                   'name'      => 'root',
                   'list'      => array(),
        );

        foreach ($elearningcatagories as $elearningcatagory) {
            $data[$elearningcatagory->id] = array(
                    //'id'          => $elearningcatagory->id,
                    'parent_id'   => $elearningcatagory->parent_id,
                    'name'        => $elearningcatagory->name,
                    'type'        => $elearningcatagory->type,
                    'description' => $elearningcatagory->description,
                    'thumbnail'   => $elearningcatagory->thumbnail,
                    'list'        => array(),
            );
            if ($elearningcatagory->type == 'contents') {
                foreach ($contents as $content) {
                   if ($content['catagory_id'] == $elearningcatagory->id) {
                       array_push($data[$elearningcatagory->id]['list'], $content);
                   }
                }
            }
            echo "Elearning Catagory ID : ".$elearningcatagory->id."<br>";
            echo "JSON String : ".json_encode($data[$elearningcatagory->id])."<br>--------------------<br>";
        }

        $parents = ELearningCatagory::distinct()->select('parent_id')
                                  ->where('status', true)
                                  ->where('proj_id', $proj_id)
                                  ->orderBy('parent_id', 'desc')
                                  ->get();

        foreach ($parents as $parent) {
            //echo "parent : ". $parent->parent_id."<br>";
            $p1 = $data[$parent->parent_id];
            foreach ($data as $list) {
                if ($list['name'] != 'root') {
               	    if ($parent->parent_id == $list['parent_id']) {
                        array_push($data[$parent->parent_id]['list'], $list);
                        //echo "data : ". json_encode($p1)."<br>";
                    }
                }
            }
            //echo "string = ".json_encode($p1)."<br><br>";
        }

        return json_encode($data[0]['list']);
    }

}
