<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startpage extends Model
{
    use HasFactory;

    protected $table = 'startpages';

    protected $fillable = [
        'proj_id',
        'name',
        'mime_type',
        'url',
        'descriptions',
        'intervals',
        'status',
        'start_datetime',
        'stop_datetime',
    ];
}
