<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\UserRole;

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

    public function orders() {
        return $this->hasMany(Order::class, 'member_id');
    }

    public function distrobuters() {
        $id = $this->user_id;
        $introduced_m = Member::where('introducer_id', $id)
                              ->get();
        $array = $introduced_m->pluck('user_id')->toArray();
        $introduceds = User::where('role', UserRole::Distrobuter)->whereIn('id', $array)->get();
        $array_u = $introduceds->pluck('id')->toArray();
        $distrobuters = Member::whereIn('user_id', $array_u)->get();
        return $distrobuters;
    }

    public function customers() {
        $id = $this->user_id;
        $introduced_m = Member::where('introducer_id', $id)
                              ->get();
        $array = $introduced_m->pluck('user_id')->toArray();
        $introduceds = User::where('role', UserRole::Member)->whereIn('id', $array)->get();
        $array_u = $introduceds->pluck('id')->toArray();
        $customers = Member::whereIn('user_id', $array_u)->get();

        return $customers;
    }
}
