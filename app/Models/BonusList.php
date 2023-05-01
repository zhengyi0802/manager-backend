<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusList extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'order_id',
        'amount',
        'process_status',
    ];

    public function member() {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function manager() {
        return $this->belongsTo(Manager::class, 'member_id');
    }

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
