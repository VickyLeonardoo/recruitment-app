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
                'name' => 'Human Resource Development',
                'slug' => 'human-resource-development',
            ],
            [
                'code' => 'FIN',
                'name' => 'Finance',
                'slug' => 'finance',
            ],
            [
                'code' => 'IT',
                'name' => 'Information Technology',
                'slug' => 'information-technology',
            ],
            [
                'code' => 'MKT',
                'name' => 'Marketing',
                'slug' => 'marketing',
            ]
        ];

        DB::table('departements')->insert($departement);
    }
}
