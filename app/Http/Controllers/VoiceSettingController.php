<?php

namespace App\Http\Controllers;

use App\Models\VoiceSetting;
use App\Models\Project;
use Illuminate\Http\Request;

class VoiceSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voicesettings = VoiceSetting::leftJoin('projects', 'proj_id', 'projects.id')
                                     ->select('voice_settings.*', 'projects.name as project')
                                     ->latest()
                                     ->paginate(5);
        return view('voicesettings.index', compact('voicesettings'))
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

        return view('voicesettings.create', compact('projects'));
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
            'keywords' => 'required',
            'label'    => 'required',
            'package'  => 'required',
            'status'   => 'required',
        ]);

        VoiceSetting::create($request->all());

        return redirect()->route('voicesettings.index')
                        ->with('success','Voice Setting created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoiceSetting  $voiceSetting
     * @return \Illuminate\Http\Response
     */
    public function show(VoiceSetting $voicesetting)
    {
        $id = $voicesetting->id;
        $voicesetting = VoiceSetting::leftJoin('projects', 'proj_id', 'projects.id')
                                    ->select('voice_settings.*', 'projects.name as projects')
                                    ->where('voice_settings.id', $id)->first();

        return view('voicesettings.show', compact('voicesetting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoiceSetting  $voiceSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(VoiceSetting $voicesetting)
    {
        $projects = Project::where('status', true)->get();

        return view('voicesettings.edit', compact('voicesetting'))
               ->with(compact('projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VoiceSetting  $voiceSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VoiceSetting $voicesetting)
    {
        $request->validate([
            'keywords' => 'required',
            'label'    => 'required',
            'package'  => 'required',
            'status'   => 'required',
        ]);

        $voicesetting->update($request->all());

        return redirect()->route('voicesettings.index')
                        ->with('success','Voice Setting updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoiceSetting  $voiceSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoiceSetting $voicesetting)
    {
        $voicesetting->delete();

        return redirect()->route('voicesettings.index')
                        ->with('success','Voice Setting deleted successfully');
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

        $result = null;
        $voicesettings = VoiceSetting::select('keywords', 'label', 'package', 'link_url')->where('proj_id', $proj_id)->where('status', true)->get();
        if ($voicesettings) {
            $result = $voicesettings->toArray();
        }

        return json_encode($result);
    }

}
