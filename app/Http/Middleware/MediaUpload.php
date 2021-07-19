<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Models\File;

class MediaUpload
{

    public function __construct()
    {

    }

    public static function fileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,jpg,png,gif,mkv,mp4,ts,flv'
        ]);

        $user = auth()->user()->id;
        $filename = 'u'.$user.'-'.time().'.'.$request->file->getClientOriginalExtension();
        echo $request->mime_type;

        $file = new File();
        if ($request->file()) {
            if ($request->mime_type == 'image') {
                $filePath = $request->file('file')->storeAs('images/', $filename, 'public');
            } else if ($request->mime_type == 'i_video') {
                $filePath = $request->file('file')->storeAs('videos/', $filename, 'public');
            }
            $file->name= $filename;
            $file->file_path = '/storage/'.$filePath;
            $file->save();
        }
        return $file;

    }

}
