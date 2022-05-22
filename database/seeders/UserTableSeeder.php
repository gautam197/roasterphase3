<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'System Administrator',
            'username' => 'system.admin',
            'email' => 'system.admin@gmail.com',
            'password' => bcrypt('Test@12')
        ]);

        $role = Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'web'
        ]);

        $user->assignRole($role);
    }
}
