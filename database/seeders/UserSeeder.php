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
                      'phone'       => 'manager',
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
