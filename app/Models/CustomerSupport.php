<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSupport extends Model
{
    use HasFactory;

    protected $fillable = [
        'proj_id',
        'qrcode_type',
        'qrcode_content',
        'rcapp',
        'rcapp_url',
        'status',
    ];

}
