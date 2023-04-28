<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company',
        'cid',
        'pid',
        'address',
        'memo',
        'created_by',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

}
