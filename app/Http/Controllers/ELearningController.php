<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\ELearningCatagory;
use App\Models\ELearning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ELearningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elearnings = ELearning::leftJoin('e_learning_catagories', 'catagory_id', 'e_learning_catagories.id')
                       ->select('e_learnings.*', 'e_learning_catagories.name as catagory')->paginate(5);

        return view('elearnings.index',compact('elearnings'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $elearningcatagories = ELearningCatagory::where('status', true)
                                                ->where('type', 'contents')
                                                ->get();

        return view('elearnings.create', compact('elearningcatagories'));
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
            'catagory_id'   => 'required',
            'name'          => 'required',
            'mime_type'     => 'required',
            'url'           => 'required',
            'status'        => 'required',
        ]);

        $elearning = new ELearning;

        $elearning->catagory_id = $request->catagory_id;
        $elearning->name        = $request->name;
        $elearning->description = $request->description;
        $elearning->mime_type   = $request->mime_type;
        $elearning->url         = $request->url;
        $elearning->status      = $request->status;

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $elearning->preview = $file->file_path;
        }

        $elearning->save();

        return redirect()->route('elearnings.index')
                        ->with('success', 'ELearning deleted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ELearning  $eLearning
     * @return \Illuminate\Http\Response
     */
    public function show(ELearning $elearning)
    {
        $id = $elearning->id;
        $elearning = DB::table('e_learnings')
                        ->leftJoin('e_learning_catagories', 'catagory_id', 'e_learning_catagories.id')
                        ->select('e_learnings.*', 'e_learning_catagories.name as catagory')
                        ->where('e_learnings.id', $id)->first();

        return view('elearnings.show', compact('elearning'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ELearning  $eLearning
     * @return \Illuminate\Http\Response
     */
    public function edit(ELearning $elearning)
    {
        $elearningcatagories = ELearningCatagory::where('status', true)
                                                ->where('type', 'contents')
                                                ->get();

        return view('elearnings.edit', compact('elearning'))
               ->with(compact('elearningcatagories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ELearning  $eLearning
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ELearning $elearning)
    {
        $request->validate([
            'catagory_id'   => 'required',
            'name'          => 'required',
            'mime_type'     => 'required',
            'url'           => 'required',
            'status'        => 'required',
        ]);

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $request->merge(['preview',  $file->file_path]);
        }

        $elearning->update($request->all());

        return redirect()->route('elearnings.index')
                        ->with('success', 'ELearning deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ELearning  $eLearning
     * @return \Illuminate\Http\Response
     */
    public function destroy(ELearning $elearning)
    {
        $elearning->delete();

        return redirect()->route('elearnings.index')
                        ->with('success', 'ELearning deleted successfully');
    }

    public function query(Request $request)
    {
         $catagory_id = $request->input('catagory_id');
         $elearnings = ELearning::where('catagory_id', $catagory_id)
                       ->where('status', true)
                       ->get();

         if ($elearnings != null)
            return json_encode($elearnings);

    }

}
