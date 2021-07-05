<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    use HasFactory;

    protected $fillable = [
        'proj_id',
        'index',
        'thumbnail',
        'link_url',
        'status',
    ];

}
