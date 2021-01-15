<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
       'type_id',
       'serialno',
       'mac_address',
       'proj_id',
       'status_id',
    ];

    public function macformat($mac_address)
    {
        $mac_array = str_split($ac_address, 2);
        $macaddress = implode(':', $mac_array);
        return $macaddress;
    }

}
