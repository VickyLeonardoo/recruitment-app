<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('123'),
                'position_id' => 1,
                'is_active' => true,
                'role_id' => '1',
            ],
            [
                'name' => 'Staff',
                'email' => 'hrd@example.com',
                'password' => bcrypt('123'),
                'position_id' => 6,
                'is_active' => true,
                'role_id' => '2',
            ],
            [
                'name' => 'Staff',
                'email' => 'manager@example.com',
                'password' => bcrypt('123'),
                'position_id' => 6,
                'is_active' => true,
                'role_id' => '3',
            ]
        ];

        DB::table('staff')->insert($staff);
    }
}
