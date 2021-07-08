<?php

namespace App\Http\Controllers;

use App\Models\Project;

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


}

