<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'member_id',
        'is_manager',
        'phone',
        'address',
        'model',
        'paid_1',
        'paid_2',
        'paid_date_1',
        'paid_date_2',
        'flow_status',
        'memo',
        'completed',
    ];

    public function member() {
        return $this->belongsTo(Member::class, 'member_id');
    }

   public function manager() {
        return $this->belongsTo(Manager::class, 'member_id');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

}
