<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'tester',
            'password' => bcrypt('PASSWORD'),
            'last_login' => null,
            'is_active' => true,
            'role' => 'manager',
            'remember_token' => null,
        ]);
        User::create([
            'username' => 'tester2',
            'password' => bcrypt('PASSWORD'),
            'last_login' => null,
            'is_active' => true,
            'role' => 'agent',
            'remember_token' => null,
        ]);
    }
}
