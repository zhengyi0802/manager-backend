<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StPaid extends Model
{
    use HasFactory;
    protected $fillable = [
        'web',
        'buysafeno',
        'td',
        'mn',
        'name',
        'note1',
        'note2',
        'user_no',
        'pay_date',
        'pay_time',
        'pay_type',
        'pay_agency',
        'pay_agency_name',
        'pay_agency_tel',
        'pay_agency_address',
        'err_code',
        'err_msg',
        'invoice_no',
        'cargo_no',
        'store_id',
        'store_name',
        'chk_value',
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'td');
    }

}
