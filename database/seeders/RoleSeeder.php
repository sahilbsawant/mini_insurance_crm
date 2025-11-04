<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            "id" => 1,
            "name" => 'admin',
            "level" => '3'
        ]);

        Role::create([
            "id" => 2,
            "name" => "manager",
            "level" => '2'
        ]);

        Role::create([
            "id" => 3,
            "name" => "agent",
            "level" => '1'
        ]);
    }
}
