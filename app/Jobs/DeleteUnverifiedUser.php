<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DeleteUnverifiedUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user_id;

    /**
     * Create a new job instance.
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $user = User::find($this->user_id);

        // Kiểm tra nếu tài khoản vẫn chưa được xác minh email
        if ($user && is_null($user->email_verified_at)) {
            $user->delete(); // Xóa tài khoản
        }
    }
}
