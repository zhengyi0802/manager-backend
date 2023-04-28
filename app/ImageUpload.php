<?php

namespace App\Uploads;

class ImageUpload extends Upload
{

    //protected UploadFile $result;

    public function __construct($subpath)
    {
        $param = array(
                 'path'    => 'images',
                 'subpath' => $subpath,
                 'type'    => 'image',
               );
        parent::__construct($param);
    }

    public function process($image)
    {
        $result = parent::storage($image);

        return $result;
    }

}

