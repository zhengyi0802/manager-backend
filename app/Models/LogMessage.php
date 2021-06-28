<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'timestamp',
        'version_code',
        'version_name',
        'android',
        'mac_eth',
        'mac_wifi',
        'sn',
        'data',
    ];
}
