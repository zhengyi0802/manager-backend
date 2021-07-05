<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'proj_id',
        'type',
        'playlist',
        'description',
        'status',
    ];

}
