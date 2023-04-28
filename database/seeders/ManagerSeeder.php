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
            'user_id'     => 2,
            'cid'         => '12345678',
            'pid'         => 'A123456789',
            'address'     => '台北市內湖區',
            'memo'        => null,
            'created_by'  => 1,
        ];
        Manager::create($data);
    }
}
