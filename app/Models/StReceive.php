<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StReceive extends Model
{
    use HasFactory;

    protected $fillable = [
        'web',
        'buysafeno',
        'name',
        'user_no',
        'td',
        'mn',
        'note1',
        'note2',
        'send_type',
        'barcode_a',
        'barcode_b',
        'barcode_c',
        'post_barcode_a',
        'post_barcode_b',
        'post_barcode_c',
        'entity_atm',
        'bank_code',
        'bank_name',
        'pay_code',
        'pay_type',
        'approve_code',
        'card_no',
        'err_code',
        'err_msg',
        'card_type',
        'invoice_id',
        'cargo_id',
        'store_id',
        'store_type',
        'store_msg',
        'chk_value',
        'confirm',
        'status',
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'td');
    }

}
