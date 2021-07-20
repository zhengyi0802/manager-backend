<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\ApkManager;

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
            //$result = $thid->getPackageInfo($fileModel->file_path, $fileName);

            return $fileModel;
        }
   }

   public static function getPackageInfo($file_path, $filename)
   {
            $filepath = "/files/www/manager/public".$file_path;
            $apk = new \ApkParser\Parser($filepath);
            $manifest = $apk->getManifest();
            $apk_data['package_path'] = env('APP_URL').$file_path;
            $apk_data['package_name'] = $manifest->getPackageName();
            $apk_data['package_version_name'] = $manifest->getVersionName();
            $apk_data['package_version_code'] = $manifest->getVersionCode();
            $apk_data['sdk_version'] = $manifest->getTargetSdk()->platform;
            $resourceId = $manifest->getApplication()->getIcon();
            $resources = $apk->getResources($resourceId);
            $apk_data['icon'] = $resources[0];
            $labelResourceId = $manifest->getApplication()->getLabel();
            $appLabel = $apk->getResources($labelResourceId);
            $apk_data['label'] = $appLabel[0];
            $iconfile = str_replace(".apk", ".png", $filename);
            $content = stream_get_contents($apk->getStream($resources[0]));
            $icon_path = "public/uploads/images/".$iconfile;
            Storage::put($icon_path, $content);
            $apk_data['icon'] = env('APP_URL')."/storage/uploads/images/".$iconfile;

            return $apk_data;
   }

}
