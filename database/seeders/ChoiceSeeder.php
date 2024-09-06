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
        $faker = Faker::create();

        // Ambil semua pertanyaan dari tabel questions
        $questions = DB::table('questions')->get();

        // Untuk setiap pertanyaan, buat 4 pilihan jawaban
        foreach ($questions as $question) {
            $labels = ['A', 'B', 'C', 'D'];
            $correctAnswer = rand(0, 3); // Random index untuk menentukan jawaban benar

            for ($i = 0; $i < 4; $i++) {
                DB::table('choices')->insert([
                    'question_id' => $question->id,
                    'choice' => $faker->sentence(5), // Random kalimat untuk jawaban
                    'choiceImage' => null, // Nullable image
                    'is_correct' => ($i == $correctAnswer), // Set true untuk jawaban yang benar
                    'label' => $labels[$i], // Label A, B, C, D
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
