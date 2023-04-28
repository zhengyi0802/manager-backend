<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'amount',
        'date_since',
        'date_finish',
        'process_status',
    ];

    public function member() {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
