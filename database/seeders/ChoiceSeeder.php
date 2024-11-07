<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all true_false questions
        $questions = DB::table('questions')->where('type', 'true_false')->get();

        foreach ($questions as $question) {
            // Insert 'True' choice
            DB::table('choices')->insert([
                'question_id' => $question->id,
                'choice' => 'True',
                'choiceImage' => null,
                'is_correct' => rand(0, 1) == 1, // Randomly set True as correct answer
                'label' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert 'False' choice
            DB::table('choices')->insert([
                'question_id' => $question->id,
                'choice' => 'False',
                'choiceImage' => null,
                'is_correct' => rand(0, 1) == 0, // Randomly set False as correct answer
                'label' => 'B',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}