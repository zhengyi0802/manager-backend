<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'proj_id',
        'position',
        'prev_id',
        'mime_type',
        'content',
        'video_url',
        'image_url',
        'url_link',
        'status',
    ];


}
