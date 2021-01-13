<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Models\File;

class FileUpload {

  public function __construct() {

  }

  public static function fileUpload(Request $req, $field) {
        $req->validate([
            $field => 'required'
        ]);

        $fileModel = new File;
        var_dump($field);
        if($req->file()) {
            $fileName = time().'_'.$req->$field->getClientOriginalName();
            $filePath = $req->file($field)->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time().'_'.$req->$field->getClientOriginalName();
            $fileModel->file_path = '/storage/image/' . $filePath;
            var_dump($fileModel);
            //$fileModel->save();

            return $fileModel;
        }
   }

}
