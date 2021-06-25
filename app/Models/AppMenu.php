<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'proj_id',
        'position',
        'name',
        'thumbnail',
        'url',
        'status',
    ];

}
