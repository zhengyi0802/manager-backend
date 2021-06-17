<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ELearning extends Model
{
    use HasFactory;

    protected $fillable = [
        'catagory_id',
        'name',
        'description',
        'preview',
        'mime_type',
        'url',
        'status',
    ];

}
