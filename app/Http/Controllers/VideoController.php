<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoCatagory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use FFMpeg;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $videos = Video::leftJoin('users', 'user_id', 'users.id')
                       ->leftjoin('video_catagories', 'catagory_id', 'video_catagories.id')
                       ->select('videos.*', 'video_catagories.name as catagory', 'users.name as user')
                       ->latest()
                       ->paginate(5);

        return view('videos.index', compact('videos'))
               ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //var_dump(json_encode(auth()->user()));
        $user_id = auth()->user()->id;
        $catagories = VideoCatagory::where('status', true)
                              ->where('user_id', $user_id)
                              ->orWhere('user_id', 1)
                              ->get();
        return view('videos.create', compact('catagories'));
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
            'title'  => 'required',
            'file'   => 'required',
            'status' => 'required',
        ]);

        $user_id = auth()->user()->id;
        $filename = 'u'.$user_id.'-'.time();
        $videofile = $filename.'.'.request()->file->getClientOriginalExtension();
        $thumbnail = $filename.'.png';
        $thumbnail_url = '/storage/thumbnails'.$thumbnail;
        $request->file->move(public_path('storage/videos'), $videofile);
        $video_url ='/storage/videos/'.$videofile;

        FFMpeg::fromDisk('videos')
              ->open($videofile)
              ->getFrameFromSeconds(10)
              ->export()
              ->toDisk('thumbnails')
              ->save($thumbnail);

        $video = new Video;

        $video->user_id     = $user_id;
        $video->catagory_id = $request->input('catagory_id');
        $video->title       = $request->input('title');
        $video->description = $request->input('description');
        $video->status      = $request->input('status');
        $video->video_url   = $video_url;
        $video->thumbnail   = $thumbnail_url;
        $video->save();

        return redirect()->route('videos.index')
                        ->with('success', 'Video stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        $video_id = $video->id;
        $user_id = auth()->user()->id;
        $video = Video::leftJoin('users', 'user_id', 'users.id')
                      ->leftjoin('video_catagories', 'catagory_id', 'video_catagories.id')
                      ->select('videos.*', 'video_catagories.name as catagory', 'users.name as user')
                      ->where('videos.id', $video_id)->first();

        return view('videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $user_id = auth()->user()->id;
        $catagories = VideoCatagory::where('status', true)
                              ->where('user_id', $user_id)
                              ->orWhere('user_id', 1)
                              ->get();

        return view('videos.edit', compact('video'))
               ->with(compact('catagories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $user_id = auth()->user()->id;

        $request->merge(['user_id' => $user_id]);

        $video->update($request->all());

        return redirect()->route('videos.index')
                        ->with('success', 'Video updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('videos.index')
                        ->with('success', 'Video deleted successfully');
    }
}
