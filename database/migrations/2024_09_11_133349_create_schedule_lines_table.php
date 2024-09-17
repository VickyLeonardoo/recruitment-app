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
        Schema::create('schedule_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->references('id')->on('schedules');
            $table->foreignId('application_id')->references('id')->on('applications');
            $table->enum('result',['Pending','Approved','Rejected']);
            $table->boolean('is_mark')->default(false);
            $table->boolean('is_email')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_lines');
    }
};
