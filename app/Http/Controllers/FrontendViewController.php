<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Product;
use App\Models\Material;
use App\Models\Logo;
use App\Models\Business;
use App\Models\Advertising;
use App\Models\MainVideo;
use App\Models\Bulletin;
use App\Models\AppMenu;
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
        //$frontend_view = $this->getMaterials($project->id);
        $frontend_view = $this->getElements($project->id);
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

    public function getMaterials($id)
    {
        $materials = [];
        for ($i=1; $i < 19; $i++) {
           $block = Material::where('proj_id', $id)->where('position', $i)->where('status', true)->where('prev_id', '0')->first();
           $materials += ['block'.$i => $block];
        }

        return $materials;
    }

    public function getElements($id)
    {
         $logo = Logo::select('image')
                     ->where('proj_id', $id)
                     ->orWhere('proj_id', 0)
                     ->where('status', true)
                     ->orderBy('updated_at', 'desc')
                     ->first();

         $business = Business::select('logo_url')
                             ->where('proj_id', $id)
                             ->where('status', true)
                             ->orderBy('updated_at', 'desc')
                             ->first();

         $advertising = Advertising::select('thumbnail')
                                   ->where('proj_id', $id)
                                   ->where('status', true)
                                   ->orderBy('updated_at', 'desc')
                                   ->first();

         $mainvideo = MainVideo::select('type', 'playlist')
                               ->where('proj_id', $id)
                               ->where('status', true)
                               ->orderBy('updated_at', 'desc')
                               ->first();
         if ($mainvideo) {
             $videos = $mainvideo->toArray();
         }

         $bulletin = Bulletin::select('title')
                             ->where('proj_id', $id)
                             ->where('status', true)
                             ->orderBy('updated_at', 'desc')
                             ->first();

         $appmenus = AppMenu::select('position', 'thumbnail')
                            ->where('proj_id', $id)
                            ->where('status', true)
                            ->orderBy('position', 'asc')
                            ->get();

         $apps = array(null, null, null, null, null, null, null, null, null);
         foreach ($appmenus as $appmenu) {
             $apps[$appmenu->position-1] = $appmenu->thumbnail;
         }

         $result = array(
                        'logo'       => $logo->image,
                        'customLogo' => ($business) ? $business->logo_url : null,
                        'ad'         => ($advertising) ? $advertising->thumbnail : null,
                        'videos'     => $mainvideo,
                        'bulletin'   => ($bulletin) ? $bulletin->title : null,
                        'apps'       => $apps,
                   );
         //var_dump($result);

         return $result;
    }

    public function query2(Request $request)
    {
        if ($request->input('mac')) {
            $mac = str_replace(':', '', $request->input('mac'));
            $mac = strtoupper($mac);
            $product = Product::where('ether_mac', '=', $mac)
                              ->orWhere('wifi_mac', '=', $mac)
                              ->firstOrFail();
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


    public function queryLogo($proj_id)
    {
        $logo = Logo::where('proj_id', $proj_id)
                     ->where('status', true)
                     ->orderBy('updated_at', 'desc')
                     ->first();

        if ($logo == null) {
            $proj_id = 0;
            $logo = Logo::where('proj_id', $proj_id)
                         ->where('status', true)
                         ->orderBy('updated_at', 'desc')
                         ->first();
        }

        $result = array(
                  'name'      => $logo->name,
                  'image'     => $logo->image,
                  'link_url'  => $logo->link_url,
        );

        return $result;
    }

    public function queryBusiness($proj_id)
    {
        $business = Business::where('proj_id', $proj_id)
                            ->where('status', true)
                            ->orderBy('updated_at', 'desc')
                            ->first();

        $result = array(
                   'image'     => $business->logo_url,
                   'link_url'  => $business->link_url,
        );

        return $result;
    }

    public function queryAdvertisings($proj_id)
    {
         $advertistings = Advertising::select('index', 'thumbnail as image', 'link_url')
                                     ->where('proj_id', $proj_id)
                                     ->where('status', true)
                                     ->orderBy('index', 'asc')
                                     ->get();
         $result = $advertistings->toArray();

         return $result;
    }

    public function queryMainVideo($proj_id)
    {
         $mainvideo = MainVideo::select('type', 'playlist')
                               ->where('proj_id', $proj_id)
                               ->where('status', true)
                               ->orderBy('updated_at', 'desc')
                               ->first();
         $result = $mainvideo->toArray();

         return $result;
    }

    public function query(Request $request)
    {
       if ($request->input('mac')) {
            $mac = str_replace(':', '', $request->input('mac'));
            $mac = strtoupper($mac);
            $product = Product::where('ether_mac', '=', $mac)
                                ->orWhere('wifi_mac', '=', $mac)
                                ->firstOrFail();
            //var_dump($product);
            if ($product) {
                $proj_id = $product->proj_id;
            }
        } else if ($request->input('id')) {
            $proj_id = $request->input('id');
        }

        $logo       = $this->queryLogo($proj_id);
        $customLogo = $this->queryBusiness($proj_id);
        $ad         = $this->queryAdvertisings($proj_id);
        $videos     = $this->queryMainVideo($proj_id);
        $result = array(
            'logo'        => $logo,
            'customLogo'  => $customLogo,
            'ad'          => $ad,
            'videos'      => $videos,
        );

        return json_encode($result);
    }

}
