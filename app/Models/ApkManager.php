<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApkManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'launher_id',
        'label',
        'package_name',
        'package_version_name',
        'package_version_code',
        'sdk_version',
        'icon',
        'description',
        'path',
        'status',
        'type_id',
        'proj_id',
        'mac_addresses',
    ];

}
