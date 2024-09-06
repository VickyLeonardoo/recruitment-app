<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'code' => 'MC200001',
                'title' => 'Software Engineer I',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',
                'position_id' => 2,
                'departement_id' => 4,
                'requirement' => 'requirement',
                'qualification' => 'qualification',
                'type' => 'FULL TIME',
                'start_date' => Date::now(),
                'end_date' => Date::now(),
                'status' => 'Active',
                'min_salary' => '10000',
                'max_salary' => '10000',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ]
        ];
        DB::table('job_vacancies')->insert($data);

    }
}
