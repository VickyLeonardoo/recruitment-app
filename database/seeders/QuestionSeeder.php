<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 50 questions, 40 with Faker
        for ($i = 0; $i < 50; $i++) {
            DB::table('questions')->insert([
                'description' => $faker->sentence(10), // Generate random sentence
                'image' => null, // Nullable image
                'difficult' => $faker->randomElement(['easy', 'medium', 'hard']),
                'type' => $faker->randomElement(['multiple_choice', 'true_false']),
                'is_active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
