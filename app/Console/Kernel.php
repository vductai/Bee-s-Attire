<?php

namespace App\Console;

use App\Jobs\DeleteVoucherJob;
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
        $schedule->job(new SendMailVoucherExpiredJob())->everyMinute();  // everyMinute(): chạy từng phút
        $schedule->job(new DeleteVoucherJob())->everyMinute();
        $schedule->call(function () {
            User::whereNull('email_verified_at')  // Chọn những tài khoản chưa xác minh email
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
