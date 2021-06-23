<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QAList extends Model
{
    use HasFactory;

    protected $fillable = [
        'catagory_id',
        'question',
        'type',
        'answer',
        'status',
    ];


}
