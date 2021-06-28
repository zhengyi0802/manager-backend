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
        $logmessages = LogMessages::latest()->paginate(5);

        return view('logmessages.index', compact('logmessages'))
               ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('logmessages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        LogMessage::create($request->all());

        return redirect()->route('logmessages.index')
                        ->with('success','Log Message created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LogMessage  $logMessage
     * @return \Illuminate\Http\Response
     */
    public function show(LogMessage $logmessage)
    {
        return view('logmessages.show', compact('logmessage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LogMessage  $logMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(LogMessage $logmessage)
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
    public function update(Request $request, LogMessage $logmessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LogMessage  $logMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogMessage $logmessage)
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
