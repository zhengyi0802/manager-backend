<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\UserRole;

class Manager extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'user_id',
        'company',
        'share',
        'bonus',
        'cid',
        'pid',
        'pid_image_1',
        'pid_image_2',
        'bank',
        'bank_name',
        'account',
        'address',
        'share_status',
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

    public function resellers() {
        $id = $this->user_id;
        $introduced_m = Member::where('introducer_id', $id)
                              ->get();
        $array = $introduced_m->pluck('user_id')->toArray();
        $introduceds = User::where('role', UserRole::Reseller)->whereIn('id', $array)->get();
        $array_u = $introduceds->pluck('id')->toArray();
        $resellers = Member::whereIn('user_id', $array_u)->get();
        return $resellers;
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

}
