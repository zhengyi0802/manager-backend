<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'introducer_id',
        'address',
        'pid',
        'bank',
        'bank_name',
        'account',
        'bonus',
        'share',
        'creadit_card',
        'creadit_expire',
        'pid_image_1',
        'pid_image_2',
        'memo',
        'created_by',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function introducer() {
        return $this->belongsTo(User::class, 'introducer_id');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
