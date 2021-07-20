<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulletinItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulletin_id',
        'mime_type',
        'url',
        'status',
    ];

}
