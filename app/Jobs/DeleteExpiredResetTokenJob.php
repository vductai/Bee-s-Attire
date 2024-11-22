<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class DeleteExpiredResetTokenJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 120; // thời gian tối đa chạy jod

    public function handle()
    {
        DB::table('password_reset_tokens')
            ->where('created_at', '<', now()->subMinutes(5)) // xóa token quá 5p
            ->delete();
    }
}
