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
        'prepaid_paid',
        'paid_date',
        'prepaid_unpaid',
        'flow_status',
        'memo',
        'completed',
    ];

    public function member() {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

}
