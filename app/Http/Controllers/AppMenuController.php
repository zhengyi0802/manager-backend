<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Http\Middleware\PackageUpload;
use App\Models\AppMenu;
use App\Models\Project;
use App\Models\Product;
use App\Models\ApkManager;
use Illuminate\Http\Request;

class AppMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appmenus = AppMenu::leftJoin('projects', 'proj_id', 'projects.id')
                             ->select('app_menus.*', 'projects.name as project')
                             ->latest()->paginate(5);

        return view('appmenus.index', compact('appmenus'))
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

        return view('appmenus.create', compact('projects'));
    }

    public function create2(Project $project, $position)
    {
        $appmenu = new AppMenu;
        $appmenu->id = 0;

        return view('appmenus.create2', compact('appmenu'))
               ->with(compact('project'))
               ->with('position', $position);
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
            'position'     => 'required',
            'status'       => 'required',
        ]);

        $appmenu = new AppMenu;

        $appmenu->proj_id  = $request->proj_id;
        $appmenu->position = $request->position;
        $appmenu->name     = $request->name;
        $appmenu->url      = $request->url;
        $appmenu->status   = $request->status;

        if ($request->file()) {
            if ($request->image) {
               $file = ImageUpload::fileUpload($request);
                if ($file == null) {
                    return back()->with('image', $fileName);
                }
                $appmenu->thumbnail = env('APP_URL').$file->file_path;
            }
            if ($request->app_file) {
                $apkmanager = new ApkManager;
                $filename = $request->app_file->getClientOriginalName();
                $file = PackageUpload::fileUpload($request);
                if ($file == null) {
                    return back()->with('apkmanager', $fileName);
                }
                $data = PackageUpload::getPackageInfo($file->file_path, $filename);
                $apkmanager->launcher_id = -1;
                $apkmanager->status = true;
                $apkmanager->label = $data['label'];
                $apkmanager->package_name = $data['package_name'];
                $apkmanager->package_version_name = $data['package_version_name'];
                $apkmanager->package_version_code = $data['package_version_code'];
                $apkmanager->sdk_version = $data['sdk_version'];
                $apkmanager->icon = $data['icon'];
                $apkmanager->path = $data['package_path'];
                $apkmanager->save();

                $appmenu->name = $data['label'];
                $appmenu->url  = $data['package_path'];
                $appmenu->thumbnail = $data['icon'];
            }
        }
        $appmenu->save();

        return redirect()->route('appmenus.index')
                        ->with('success','AppMenu created successfully');
    }

    public function store2(Request $request, Project $project, $position, AppMenu $appmenu)
    {
        $request->validate([
            'name'         => 'required',
            'status'       => 'required',
        ]);

        $data = $request->all();
        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $data['thumbnail'] = env('APP_URL').$file->file_path;
        }

        $data['proj_id']  = $project->id;
        $data['position'] = $position;
        if ($appmenu->id > 0) {
            $appmenu->update($data);
        } else {
            AppMenu::create($data);
        }

        return redirect()->route('frontend_views.edit', compact('project'))
                        ->with('success','AppMenu created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppMenu  $appMenu
     * @return \Illuminate\Http\Response
     */
    public function show(AppMenu $appmenu)
    {
        $id = $appmenu->id;
        $appmenu = AppMenu::leftjoin('projects', 'proj_id', 'projects.id')
                            ->select('app_menus.*', 'projects.name as project')
                            ->where('app_menus.id', $id)->first();

        return view('appmenus.show', compact('appmenu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppMenu  $appMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(AppMenu $appmenu)
    {
        $projects = Project::where('status', true)->get();

        return view('appmenus.edit', compact('appmenu'))
               ->with(compact('projects'));
    }

    public function edit2(Project $project, $position)
    {
        $appmenu = AppMenu::where('proj_id', $project->id)
                          ->where('position', $position)
                          ->orderBy('updated_at', 'desc')
                          ->first();

        if ($appmenu == null) {
            return $this->create2($project, $position);
        }

        return view('appmenus.edit2',compact('appmenu'))
               ->with(compact('project'))
               ->with('position', $position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppMenu  $appMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppMenu $appmenu)
    {
        $request->validate([
            'proj_id'      => 'required',
            'position'     => 'required',
            'name'         => 'required',
            'status'       => 'required',
        ]);

        $appmenu->proj_id  = $request->proj_id;
        $appmenu->position = $request->position;
        $appmenu->name     = $request->name;
        $appmenu->url      = $request->url;
        $appmenu->status   = $request->status;

        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            if ($file == null) {
                return back()->with('image', $fileName);
            }
            $appmenu->thumbnail = env('APP_URL').$file->file_path;
        }
        $appmenu->save();

        return redirect()->route('appmenus.index')
                        ->with('success','AppMenu created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppMenu  $appMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppMenu $appmenu)
    {
        $appmenu->delete();

        return redirect()->route('appmenus.index')
                        ->with('success','APP Menus deleted successfully');
    }

    public function query(Request $request)
    {
        if ($request->input('mac')) {
            $mac = str_replace(':', '', $request->input('mac'));
            $mac = strtoupper($mac);
            $product = Product::where('ether_mac', '=', $mac)
                                ->orWhere('wifi_mac', '=', $mac)
                                ->first();
            //var_dump($product);
            if ($product) {
                $proj_id = $product->proj_id;
            } else {
                return json_encode(array());
            }
        } else if ($request->input('id')) {
            $proj_id = $request->input('id');
        }

        $appmenus = AppMenu::where('proj_id', $proj_id)
                             ->where('status', true)
                             ->get();
        if ($appmenus) {
            $response = array();
            foreach ($appmenus as $appmenu) {
                     $item = array(
                          'position'  => $appmenu->position,
                          'name'      => $appmenu->name,
                          'thumbnail' => $appmenu->thumbnail,
                          'url'       => $appmenu->url,
                     );
                     array_push($response, $item);
            }
            return json_encode($response);
        }
    }

}
