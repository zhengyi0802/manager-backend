<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $userdata = array(
                  [
                      'name'        => 'system',
                      'phone'       => 'system',
                      'line_id'     => 'system',
                      'password'    => bcrypt('mundi8888'),
                      'role'        => UserRole::System,
                      'status'      => true,
                      'created_by'  => 1,
                  ],
                  [
                      'name'        => 'Admin',
                      'phone'       => 'admin',
                      'line_id'     => 'admin',
                      'password'    => bcrypt('mundi8888'),
                      'role'        => UserRole::Administrator,
                      'status'      => true,
                      'created_by'  => 1,
                  ],
                  [
                      'name'        => '系統管理員',
                      'phone'       => 'Administrator',
                      'line_id'     => 'administrator',
                      'password'    => bcrypt('1234567890'),
                      'role'        => UserRole::Administrator,
                      'status'      => true,
                      'created_by'  => 1,
                  ],
                  [
                      'name'        => '總公司業務群',
                      'phone'       => '0000000000',
                      'line_id'     => 'manager',
                      'password'    => bcrypt('manager'),
                      'role'        => UserRole::Manager,
                      'status'      => true,
                      'created_by'  => 1,
                  ],
              );
        foreach($userdata as $user) {
            User::create($user);
        }
    }
}
