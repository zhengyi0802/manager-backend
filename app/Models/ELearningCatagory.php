<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ELearningCatagory extends Model
{
    use HasFactory;

    protected $fillable = [
        'proj_id',
        'name',
        'description',
        'preview',
        'status',
    ];


}
