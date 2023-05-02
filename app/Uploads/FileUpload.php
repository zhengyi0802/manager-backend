<?php

namespace App\Uploads;

use Illuminate\Http\Request;
use App\Models\File;

class FileUpload {

  public function __construct() {

  }

  public static function fileUpload(Request $req, $field) {
        if($req->file()) {
            $fileName = time().'_'.$req->$field->getClientOriginalName();
            $filePath = $req->file($field)->storeAs('images', $fileName, 'public');

            $filepath = 'storage/'.$filePath;
            return $filepath;
        }
   }

}
