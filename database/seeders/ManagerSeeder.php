<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manager;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'user_id'     => 4,
            'company'     => '禾昌國際事業股份有限公司',
            'cid'         => '',
            'pid'         => '',
            'address'     => '台北市內湖區新湖三路196號3樓',
            'memo'        => null,
            'created_by'  => 1,
        ];
        Manager::create($data);
    }
}
