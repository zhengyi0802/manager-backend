<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ApiInterfaceController extends Controller
{

    public function projectapi(Request $request)
    {
        $func = $request->input('func');

        $rid        = $request->input('id');
        $sales_id   = $request->input('sales_id');
        $name       = $request->input('name');
        $status     = $request->input('status');
        $start_time = $request->input('start');
        $stop_time  = $request->input('stop');

        $project = new Project;
        $project->rid = $rid;
        $project->sales_id = $sales_id;
        $project->name = $name;
        $project->status = $status;
        $project->start_time = $start_time;
        $project->stop_time = $stop_time;
        $project->save();

    }

    public function register(Request $request)
    {
        $mac_eth = null;
        $mac_wifi = null;
        $sno = null;
        if ($request->input('mac_eth')) {
            $mac_eth = $request->input('mac_eth');
        }
        if ($request->input('mac_wifi')) {
            $mac_wifi = $request->input('mac_wifi');
        }
        if ($request->input('sno')) {
            $sno = $request->input('sno');
        }

        $url   = "https://mundifar.com/mundi/api_test.php";
        $str1  = "token=lakjhfklbyrcf;oasdniuvfp%27omsaigvepo";
        $str2  = "wMAC=".$mac_wifi;
        $str3  = "eMAC=".$mac_eth;
        $str4  = "SerialNo=".$sno;

        $url = $url."?".$str1."&".$str2."&".$str3."&".$str4;

        $response = Http::get($url);

        return $response;

    }

}

