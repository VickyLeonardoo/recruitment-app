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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('title');
            $table->string('description');
            $table->string('position_id')->reference('id')->on('positions');
            $table->string('departement_id')->reference('id')->on('departements');
            $table->text('requirement');
            $table->text('qualification');
            $table->string('type');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->boolean('status')->default(true);
            $table->boolean('is_archive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
