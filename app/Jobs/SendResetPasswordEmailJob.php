<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendResetPasswordEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $token;
    protected $user;

    /**
     * @param $email
     * @param $token
     * @param $user
     */
    public function __construct($email, $token, $user)
    {
        $this->email = $email;
        $this->token = $token;
        $this->user = $user;
    }


    public function handle()
    {
        Mail::send('mail.Reset-password', ['token' => $this->token, 'user' => $this->user], function ($message) {
            $message->to($this->email);
            $message->subject('Yêu cầu đặt lại mật khẩu');
        });
    }
}
