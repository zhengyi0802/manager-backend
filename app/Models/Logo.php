<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = [
        'proj_id',
        'mame',
        'description',
        'image',
        'link_url',
        'status',
    ];

}
