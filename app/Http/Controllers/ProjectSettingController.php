<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Manager;

class ProjectSettingController extends Controller
{
    protected $dbname="major";

    public function index()
    {
        //$projects = DB::table('major.projects')->where('status', true)->get();
        $managers = Manager::where('status', true)->get();

        return view('projectsettings.index', compact('managers'));
    }

    public function edit(Manager $manager)
    {
        $projects = DB::table('major.projects')->where('status', true)->get();

        return view('projectsettings.edit', compact('manager'))
               ->with(compact('projects'));
    }

    public function update(Manager $manager, Request $request)
    {


    }

}
