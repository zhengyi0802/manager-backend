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
        'share_status',
        'creadit_card',
        'creadit_expire',
        'pid_image_1',
        'pid_image_2',
        'share_status',
        'memo',
        'created_by',
        'status',
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

    public function customers() {
        return $this->hasMany(Member::class, 'introducer_id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'member_id');
    }
}
