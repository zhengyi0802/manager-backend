<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Models\File;

class PackageUpload
{

  public function __construct() {

  }

  public static function fileUpload(Request $req) {
        $req->validate([
            'app_file' => 'required',
        ]);

        $fileModel = new File;

        if($req->file()) {
            $fileName = $req->app_file->getClientOriginalName();
            $filePath = $req->file('app_file')->storeAs('uploads/packages', $fileName, 'public');

            $fileModel->name = $req->app_file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();
/*
            $filepath = "/files/laravel/manager/public".$fileModel->file_path;
            $apk = new \ApkParser\Parser($filepath);
            $manifest = $apk->getManifest();
            $apk_data['package'] = $manifest->getPackageName();
            $apk_data['version'] = $manifest->getVersionName();
            $apk_data['version_code'] = $manifest->getVersionCode();
            $resourceId = $manifest->getApplication()->getIcon();
            $resources = $apk->getResources($resourceId);
            $apk_data['icon'] = $resources[0];
            $labelResourceId = $manifest->getApplication()->getLabel();
            $appLabel = $apk->getResources($labelResourceId);
            $apk_data['label'] = $appLabel[0];
*/
            return $fileModel;
        }
   }

}
