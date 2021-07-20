<?php

namespace App\Http\Controllers;

use App\Models\ApkManager;
use App\Models\Project;
use App\Models\ProductType;
use App\Models\Product;
use App\Http\Middleware\PackageUpload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ApkManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apkmanagers = ApkManager::latest()->paginate(5);

        return view('apkmanagers.index', compact('apkmanagers'))
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
        $types = ProductType::where('status', true)->get();

        return view('apkmanagers.create')
               ->with(compact('projects'))
               ->with(compact('types'));
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
                 'app_file' => 'required',
        ]);

        if ($request->file()) {
           $filename = $request->app_file->getClientOriginalName();
           $file = PackageUpload::fileUpload($request);
           if ($file == null) {
               return back()->with('apkmanager', $fileName);
           }
           $data = PackageUpload::getPackageInfo($file->file_path, $filename);
           $request->merge(['label' => $data['label']]);
           $request->merge(['package_name' => $data['package_name']]);
           $request->merge(['package_version_name' => $data['package_version_name']]);
           $request->merge(['package_version_code' => $data['package_version_code']]);
           $request->merge(['sdk_version' => $data['sdk_version']]);
           $request->merge(['icon' => $data['icon']]);
           $request->merge(['path' => $data['package_path']]);
        }
        $types = $request->input('type');
        $projects = $request->input('project');
        $request->merge(['type_id' => json_encode($types)]);
        $request->merge(['proj_id' => json_encode($projects)]);

        ApkManager::create($request->all());

        return redirect()->route('apkmanagers.index')
                        ->with('success', 'APK Package store successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApkManager  $apkManager
     * @return \Illuminate\Http\Response
     */
    public function show(ApkManager $apkmanager)
    {
        return view('apkmanagers.show', compact('apkmanager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApkManager  $apkManager
     * @return \Illuminate\Http\Response
     */
    public function edit(ApkManager $apkmanager)
    {
        $projects = Project::where('status', true)->get();
        $types = ProductType::where('status', true)->get();

        return view('apkmanagers.edit', compact('apkmanager'))
               ->with(compact('projects'))
               ->with(compact('types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApkManager  $apkManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApkManager $apkmanager)
    {
        return redirect()->route('apkmanagers.index')
                        ->with('success', 'APK Package update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApkManager  $apkManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApkManager $apkmanager)
    {
        $apkmanager->delete();

        return redirect()->route('apkmanagers.index')
                        ->with('success', 'APK Package deleted successfully');
    }

    public function checkLauncher(Request $request)
    {
        $result = null;
        if ($request->input('launcher')) {
            $launcher_id = $request->input('launcher');
            $package = ApkManager::where('status', true)
                                 ->where('launcher_id', $launcher_id)
                                 ->orderBy('created_at', 'desc')
                                 ->first();
            if ($package) {
                $result = array (
                      'label'                => $package->label,
                      'package_name'         => $package->package_name,
                      'package_version_name' => $package->package_version_name,
                      'package_version_code' => $package->package_version_code,
                      'sdk_version'          => $package->sdk_version,
                      'icon'                 => $package->icon,
                      'path'                 => $package->path,
                      'description'          => $package->description,
                      'created_at'           => $package->created_at,
                );
            }
        }
        return $result;
    }

    public function query(Request $request)
    {
        $result = null;
        if ($request->input('launcher')) {
            $result = $this->checkLauncher($request);
        }

        return json_encode($result);
    }

}
