<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departement = [
            [
                'code' => 'HRD',
                'name' => 'Human Resource Development'
            ],
            [
                'code' => 'FIN',
                'name' => 'Finance'
            ],
            [
                'code' => 'IT',
                'name' => 'Information Technology'
            ],
            [
                'code' => 'MKT',
                'name' => 'Marketing'
            ]
        ];

        DB::table('departements')->insert($departement);
    }
}
