<?php

namespace App\Http\Controllers;

use App\Models\LogMessage;
use Illuminate\Http\Request;

class LogMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LogMessage  $logMessage
     * @return \Illuminate\Http\Response
     */
    public function show(LogMessage $logMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LogMessage  $logMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(LogMessage $logMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LogMessage  $logMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogMessage $logMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LogMessage  $logMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogMessage $logMessage)
    {
        //
    }

    public function storefromapp(Request $request)
    {
       $postbody='';
       // Check for presence of a body in the request
       if (count($request->json()->all())) {
          $postbody = $request->json()->all();
       }

       LogMessage::create($postbody);

       $response = "ok";

       return $response;
    }

}
