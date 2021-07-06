<?php

namespace App\Http\Controllers;

use App\Models\QAList;
use App\Models\QACatagory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class QAListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qalists = DB::table('q_a_lists')
                        ->leftJoin('q_a_catagories', 'catagory_id', 'q_a_catagories.id')
                        ->select('q_a_lists.*', 'q_a_catagories.name as catagory')->paginate(5);

        return view('qalists.index', compact('qalists'))
               ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qacatagories = QACatagory::where('status', true)->get();

        return view('qalists.create', compact('qacatagories'));
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
            'catagory_id'  => 'required',
            'type'         => 'required',
            'question'     => 'required',
            'status'       => 'required',
        ]);

        QAList::create($request->all());

        return redirect()->route('qalists.index')
                        ->with('success','QAList created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QAList  $qAList
     * @return \Illuminate\Http\Response
     */
    public function show(QAList $qalist)
    {
        $id = $qalist->id;
        $qalist = DB::table('q_a_lists')
                        ->leftJoin('q_a_catagories', 'catagory_id', 'q_a_catagories.id')
                        ->select('q_a_lists.*', 'q_a_catagories.name as catagory')
                        ->where('q_a_lists.id', $id)->first();

        return view('qalists.show', compact('qalist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QAList  $qAList
     * @return \Illuminate\Http\Response
     */
    public function edit(QAList $qalist)
    {
        $qacatagories = QACatagory::where('status', true)->get();

        return view('qalists.edit', compact('qalist'))
               ->with(compact('qacatagories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QAList  $qAList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QAList $qalist)
    {
        $request->validate([
            'catagory_id'  => 'required',
            'type'         => 'required',
            'question'     => 'required',
            'status'       => 'required',
        ]);

        $qalist->update($request->all());

        return redirect()->route('qalists.index')
                        ->with('success','QAList created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QAList  $qAList
     * @return \Illuminate\Http\Response
     */
    public function destroy(QAList $qalist)
    {
        $qalist->delete();

        return redirect()->route('qalists.index')
                        ->with('success','QAList deleted successfully');
    }

    public function query(Request $request)
    {
         $catagory_id = $request->input('catagory_id');
         $qalists = QAList::where('catagory_id', $catagory_id)
                    ->where('status', true)
                    ->get();

         //var_dump($qalists);
         if ($qalists != null)
             return json_encode($qalists);
    }

    public function queryall(Request $request)
    {
        $qacatagories = QACatagory::where('status', true)->get();
        $qalists = QAList::where('status', true)->get();

        $qaarray = array();

        foreach ($qacatagories as $qacatagory) {
                 $items = array();
                 foreach ($qalists as $qalist) {
                    if($qalist->catagory_id == $qacatagory->id) {
                        $item = array(
                              'label'     => $qalist->question,
                              'type'      => $qalist->type,
                              'content'   => $qalist->answer,
                        );
                        array_push($items, $item);
                    }
                 }
                 $menu = array(
                    'title' => $qacatagory->name,
                    'items' => $items,
                 );

                 array_push($qaarray, $menu);
        }

        return json_encode($qaarray);
    }

}
