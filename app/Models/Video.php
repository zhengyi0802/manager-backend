<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'catagory_id',
        'title',
        'thumbnail',
        'video_url',
        'description',
        'status',
    ];

}
