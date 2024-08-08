<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $position = [
            [
                'code' => 'ADM',
                'name' => 'Admin',
                'departement_id' => '1',
            ],
            [
                'code' => 'SWE I',
                'name' => 'Software Engineer I',
                'departement_id' => '3',
            ],
            [
                'code' => 'SWE II',
                'name' => 'Software Engineer II',
                'departement_id' => '3',
            ],
            [
                'code' => 'SWE III',
                'name' => 'Software Engineer III',
                'departement_id' => '3',
            ],
            [
                'code' => 'J MNG',
                'name' => 'Junior Manager',
                'departement_id' => '3',
            ],
            [
                'code' => 'MNG',
                'name' => 'Manager',
                'departement_id' => '3',
            ],
            [
                'code' => 'SUP',
                'name' => 'Supervisor',
                'departement_id' => '3'
            ]
        ];

        DB::table('positions')->insert($position);
    }
}
