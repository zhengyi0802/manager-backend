<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppAdvertising extends Model
{
    use HasFactory;

    protected $fillable = [
        'proj_id',
        'interval',
        'name',
        'thumbnail',
        'link_url',
        'status',
    ];

}
