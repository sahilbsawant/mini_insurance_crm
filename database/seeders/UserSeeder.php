<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);


        User::create([
            'id' => 2,
            'name' => 'manager User',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);

        User::create([
            'id' => 3,
            'name' => 'Agent User',
            'email' => 'agent@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 3
        ]);
    }
}
