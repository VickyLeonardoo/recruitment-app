<?php

namespace App\Console;

use App\Models\ResetPassword;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function() {
            // Menghitung waktu 10 menit yang lalu
            $now = Carbon::now()->subMinutes(10);
            
            // Mengupdate status reset password yang sudah lebih dari 10 menit
            ResetPassword::where('created_at', '<', $now)
                ->where('status', true)
                ->update(['status' => false]);
        })->hourly(); // Mengatur agar dijalankan setiap jam
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
