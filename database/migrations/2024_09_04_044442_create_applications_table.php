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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('reg_no')->unique();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('job_vacancy_id')->references('id')->on('job_vacancies');
            $table->datetime('reg_date');
            $table->enum('status',['Pending','Interview','Approved','Rejected']);
            $table->boolean('is_mark')->default(false);
            $table->boolean('is_recomended')->default(false);
            $table->boolean('is_interview')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
