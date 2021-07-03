<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use App\Models\Project;
use App\Models\Product;
use App\Models\BulletinItem;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bulletins = Bulletin::leftJoin('projects', 'proj_id', 'projects.id')
                             ->select('bulletins.*', 'projects.name as project')
                             ->latest()->paginate(5);

        return view('bulletins.index', compact('bulletins'))
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

        return view('bulletins.create', compact('projects'));
    }

    public function create2(Project $project)
    {
        $bulletin = new Bulletin;

        return view('bulletins.create2', compact('bulletin'))
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
            'title'        => 'required',
            'message'      => 'required',
            'date'         => 'required',
            'status'       => 'required',
        ]);

        Bulletin::create($request->all());

        return redirect()->route('bulletins.index')
                         ->with('success','Bulletin store successfully');
    }

    public function store2(Request $request, Project $project, Bulletin $bulletin)
    {
        $request->merge(['proj_id', $project->id]);

        if ($bulletin->id > 0) {
            $bulletin->update($request->all());
        } else {
            Bulletin::create($request->all());
        }

        return redirect()->route('frontend_views.edit', compact('project'))
                        ->with('success','Material created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bulletin  $bulletin
     * @return \Illuminate\Http\Response
     */
    public function show(Bulletin $bulletin)
    {
        $id = $bulletin->id;
        $bulletin = Bulletin::leftJoin('projects', 'proj_id', 'projects.id')
                            ->select('bulletins.*', 'projects.name as project')
                            ->where('bulletins.id', $id)->first();

        return view('bulletins.show', compact('bulletin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bulletin  $bulletin
     * @return \Illuminate\Http\Response
     */
    public function edit(Bulletin $bulletin)
    {
        $projects = Project::where('status', true)->get();

        return view('bulletins.edit', compact('bulletin'))
               ->with(compact('projects'));
    }

    public function edit2(Project $project)
    {
        $bulletin = Bulletin::where('status', true)
                            ->where('proj_id', $project->id)
                            ->orderBy('updated_at', 'desc')
                            ->first();

        if ($bulletin == null) {
            return $this->create2($project);
        }

        return view('bulletins.edit2', compact('bulletin'))
               ->with(compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bulletin  $bulletin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bulletin $bulletin)
    {
        $request->validate([
            'proj_id'      => 'required',
            'title'        => 'required',
            'message'      => 'required',
            'date'         => 'required',
            'status'       => 'required',
        ]);

        $bulletin->update($request->all());

        return redirect()->route('bulletins.index')
                         ->with('success','Bulletin store successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bulletin  $bulletin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bulletin $bulletin)
    {
        $bulletin->delete();

        return redirect()->route('bulletins.index')
                         ->with('success','Bulletin deleted successfully');
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
                //var_dump($proj_id);
            }
        } else if ($request->input('id')) {
            $proj_id = $request->input('id');
        }

        $datetime = date('y-m-d h:i:s');
        $bulletin = Bulletin::where('proj_id', $proj_id)
                               ->where('status', true)
                               ->where('date', '<=', $datetime)
                               ->orderBy('date', 'desc')
                               ->first();

        $bulletinitems = BulletinItem::where('bulletin_id', $bulletin->id)->get();

        $items = array();
        foreach($bulletinitems as $bulletinitem) {
                $item = array(
                        'id'      => $bulletinitem->id,
                        'type'    => $bulletinitem->type,
                        'content' => $bulletinitem->url,
                );
                array_push($items, $item);
        }

        $result = array(
                'id'       => $bulletin->id,
                'title'    => $bulletin->title,
                'message'  => $bulletin->message,
                'status'   => $bulletin->status,
                'date'     => $bulletin->date,
                'items'    => $items,
        );

        return json_encode($result);
    }

}
