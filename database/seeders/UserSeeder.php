<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'email' => 'user1@example.com',
                'password' => bcrypt('123'),
                'role_id' => '4',
                'is_verified' => true,
                'is_active' => true,
            ],
            [
                'email' => 'user2@example.com',
                'password' => bcrypt('123'),
                'role_id' => '4',
                'is_verified' => true,
                'is_active' => true,
            ],
            [
                'email' => 'user3@example.com',
                'password' => bcrypt('123'),
                'role_id' => '4',
                'is_verified' => true,
                'is_active' => true,
            ]
        ];
        DB::table('users')->insert($user);
    }
}
