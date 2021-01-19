<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marquee extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'proj_id',
        'product_id',
        'prev_id',
        'name',
        'content',
        'url',
        'status',
    ];

}
