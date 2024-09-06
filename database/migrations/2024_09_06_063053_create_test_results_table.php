<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->string('no');
            $table->foreignId('test_id')->references('id')->on('tests')->onDelete('cascade'); // Mengacu ke tes apa yang diikuti
            $table->foreignId('question_id')->references('id')->on('questions')->onDelete('cascade'); // Soal yang diberikan
            $table->foreignId('choice_id')->nullable()->references('id')->on('choices')->nullable()->onDelete('cascade'); // Jawaban yang dipilih user
            $table->boolean('is_correct'); // Menyimpan status benar/salah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
