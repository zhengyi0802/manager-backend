<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'launcher_id',
        'name',
        'icon_url',
        'app_path',
        'description',
        'package_version',
        'sdk_version',
        'status',
        'type_id',
        'proj_id',
        'mac_addresses',
    ];

}
