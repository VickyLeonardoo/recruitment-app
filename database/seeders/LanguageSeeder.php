<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code' => 'ENG',
                'name' => 'Bahasa Inggris'
            ],
            [
                'code' => 'IND',
                'name' => 'Bahasa Indonesia'
            ],
            [
                'code' => 'JPN',
                'name' => 'Bahasa Jepang'
            ],
            [
                'code' => 'KOR',
                'name' => 'Bahasa Korea'
            ],
            [
                'code' => 'SPA',
                'name' => 'Bahasa Spanyol'
            ],
            [
                'code' => 'GER',
                'name' => 'Bahasa Jerman'
            ],
            [
                'code' => 'ITA',
                'name' => 'Bahasa Italia'
            ],
            [
                'code' => 'FRA',
                'name' => 'Bahasa Prancis'
            ],
            [
                'code' => 'ARA',
                'name' => 'Bahasa Arab'
            ],
            [
                'code' => 'RUS',
                'name' => 'Bahasa Rusia'
            ],
            [
                'code' => 'POR',
                'name' => 'Bahasa Portugal'
            ],
            [
                'code' => 'TUR',
                'name' => 'Bahasa Turki'
            ],
        ];

        DB::table('languages')->insert($data);
    }
}
