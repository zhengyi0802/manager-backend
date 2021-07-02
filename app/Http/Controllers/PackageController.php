<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Project;
use App\Models\ProductType;
use App\Models\Product;
use App\Http\Middleware\PackageUpload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::latest()->paginate(5);

        return view('packages.index', compact('packages'))
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

        return view('packages.create')
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
               return back()->with('package', $fileName);
           }
           $request->merge(['app_path' => $file->file_path]);
           $data = $this->getPackageInfo($file->file_path, $filename);
           $request->merge(['package_version' => $data['version']]);
           $request->merge(['name' => $data['label']]);
           $request->merge(['sdk_version' => $data['sdk_version']]);
           $request->merge(['icon_url' => $data['icon_file']]);
        }
        $types = $request->input('type');
        $projects = $request->input('project');
        $request->merge(['type_id' => json_encode($types)]);
        $request->merge(['proj_id' => json_encode($projects)]);

        Package::create($request->all());

        return redirect()->route('packages.index')
                        ->with('success', 'Package store successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return view('packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $projects = Project::where('status', true)->get();
        $types = ProductType::where('status', true)->get();

        return view('packages.edit', compact('package'))
               ->with(compact('projects'))
               ->with(compact('types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        return redirect()->route('packages.index')
                        ->with('success', 'Package update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('packages.index')
                        ->with('success', 'Pacakge deleted successfully');
    }

    public function query(Request $request)
    {
        if ($request->input('launcher')) {
            $launcher_id = $request->input('launcher');
            $package = Package::where('status', true)
                       ->where('launcher_id', $launcher_id)
                       ->orderBy('created_at', 'desc')
                       ->first();
            if ($package) {
                $result = array (
                      'name'            => $package->name,
                      'package_version' => $package->package_version,
                      'sdk_version'     => $package->sdk_version,
                      'description'     => $package->description,
                      'created_at'      => $package->created_at,
                      'path'            => $package->app_path,
                );
                return json_encode($result);
            } else {
                return "{}";
            }
        } else {
            if ($request->input('mac')) {
                $mac = str_replace(':', '', $request->input('mac'));
                $mac = strtoupper($mac);
                $product = Product::where('ether_mac', '=', $mac)->firstOrFail();
                //var_dump($product);
                if ($product) {
                    $proj_id = $product->proj_id;
                    $type_id = $product->type_id;
                }
            } else if ($request->input('id')) {
                $id = $request->input('id');
                $product = Product::where('id', $id)->firstOrFail();
                $proj_id = $product->proj_id;
                $type_id = $product->type_id;
            }
            $project = Project::where('id', $proj_id)->first();
            $type = ProductType::where('id', $type_id)->first();
            $proj_name = $project->name;
            $type_name = $type->name;

            if ($request->input('package')) {
                $name = $request->input('package');
                $packages = Package::where('name', $name)->where('status', true)->get();
            } else {
                $packages = Package::where('status', true)->get();
            }
        }

        $list = array();
        $i=0;
        foreach ($packages as $package) {
           if ($package->proj_id != null) {
               $proj_array = json_decode($package->proj_id);
               foreach ($proj_array as $prj) {
                  if ($proj_name == $prj ) {
                      $type_array = json_decode($package->type_id);
                      foreach ($type_array as $type) {
                          if ($type_name == $type) {
                              $list[$i++]=$package->toArray();
                          }
                      }
                  }
               }
           }

        }

        return json_encode($list);
    }

    public function getPackageInfo($file_path, $filename) {
            $filepath = "/storage/www/manager/public".$file_path;
            $apk = new \ApkParser\Parser($filepath);
            $manifest = $apk->getManifest();
            $apk_data['package'] = $manifest->getPackageName();
            $apk_data['version'] = $manifest->getVersionName();
            $apk_data['version_code'] = $manifest->getVersionCode();
            $apk_data['sdk_version'] = $manifest->getTargetSdk()->platform;
            $resourceId = $manifest->getApplication()->getIcon();
            $resources = $apk->getResources($resourceId);
            $apk_data['icon'] = $resources[0];
            $labelResourceId = $manifest->getApplication()->getLabel();
            $appLabel = $apk->getResources($labelResourceId);
            $apk_data['label'] = $appLabel[0];
            $iconfile = str_replace(".apk", ".png", $filename);
            $content = stream_get_contents($apk->getStream($resources[0]));
            $icon_path = "public/uploads/images/".$iconfile;
            Storage::put($icon_path, $content);
            $apk_data['icon_file'] = "/storage/uploads/images/".$iconfile;

            return $apk_data;
    }

}
