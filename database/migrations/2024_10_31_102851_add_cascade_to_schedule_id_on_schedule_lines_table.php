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
        Schema::table('schedule_lines', function (Blueprint $table) {
            // Hapus foreign key lama
            $table->dropForeign(['schedule_id']);

            // Tambahkan kembali foreign key dengan onDelete('cascade')
            $table->foreign('schedule_id')
                  ->references('id')->on('schedules')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedule_lines', function (Blueprint $table) {
            // Hapus foreign key dengan onDelete('cascade')
            $table->dropForeign(['schedule_id']);

            // Tambahkan kembali foreign key tanpa onDelete('cascade')
            $table->foreign('schedule_id')
                  ->references('id')->on('schedules');
        });
    }
};
