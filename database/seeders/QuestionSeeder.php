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
        $questions = [
            "Saya merasa nyaman bekerja dalam tim.",
            "Saya selalu merasa tenang dalam situasi apapun.",
            "Saya suka mencoba hal-hal baru yang menantang.",
            "Saya dapat menyelesaikan tugas tepat waktu tanpa tekanan.",
            "Saya mudah beradaptasi dengan perubahan yang cepat.",
            "Saya selalu berpikir positif meskipun dalam situasi sulit.",
            "Saya merasa tidak mudah terganggu oleh masalah kecil.",
            "Saya cenderung mengambil keputusan dengan cepat.",
            "Saya merasa nyaman bekerja di bawah tekanan.",
            "Saya bisa menjaga fokus dalam jangka waktu yang lama.",
            "Saya merasa lebih nyaman mengikuti aturan yang sudah ada.",
            "Saya sering merasa lelah ketika bekerja dalam waktu lama.",
            "Saya mudah mengakui kesalahan dan memperbaikinya.",
            "Saya sering membantu rekan kerja tanpa diminta.",
            "Saya lebih suka pekerjaan yang tidak monoton.",
            "Saya sering merasa khawatir sebelum memulai sesuatu yang baru.",
            "Saya merasa mampu memimpin kelompok dengan baik.",
            "Saya merasa mudah untuk berbicara di depan umum.",
            "Saya lebih suka bekerja sendiri daripada dalam kelompok.",
            "Saya sering merencanakan hal-hal dengan detail.",
            "Saya tetap tenang saat menghadapi kritik dari orang lain.",
            "Saya merasa memiliki motivasi diri yang kuat.",
            "Saya dapat mengontrol emosi dengan baik dalam situasi sulit.",
            "Saya suka melakukan pekerjaan yang menuntut keteraturan.",
            "Saya sering berpikir panjang sebelum bertindak."
        ];

        foreach ($questions as $question) {
            DB::table('questions')->insert([
                'description' => $question,
                'image' => null,
                'difficult' => 'medium', // Set difficulty level as needed
                'type' => 'true_false',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}