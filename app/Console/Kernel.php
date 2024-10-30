<?php

namespace App\Console;

use App\Jobs\SendMailVoucherExpiredJob;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new SendMailVoucherExpiredJob())->hourly();  // everyMinute(): chạy từng phút
        $schedule->call(function () {
            User::whereNull('email_verified_at')  // Chọn những tài khoản chưa xác minh email
            ->where('created_at', '<', now()->subMinutes(1))  // Tài khoản tạo cách đây hơn 1 phút
            ->delete();  // Xóa tài khoản
        })->hourly();  // Chạy mỗi giờ một lần
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
