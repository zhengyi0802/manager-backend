<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoiceSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'proj_id',
        'keywords',
        'package',
        'link_url',
        'status',
    ];

}
