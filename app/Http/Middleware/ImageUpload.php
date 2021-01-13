<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Models\File;

class ImageUpload
{

  public function __construct() {

  }

  public static function fileUpload(Request $req) {
        $req->validate([
            'image' => 'required|mimes:jpeg,jpg,png,gif'
        ]);

        $fileModel = new File;

        if($req->file()) {
            $fileName = time().'_'.$req->image->getClientOriginalName();
            $filePath = $req->file('image')->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time().'_'.$req->image->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            return $fileModel;
        }
   }

}
