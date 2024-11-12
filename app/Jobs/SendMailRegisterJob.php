<?php

namespace App\Jobs;

use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailRegisterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $create;
    protected $verificationUrl;

    /**
     * @param $email
     * @param $create
     * @param $url
     */
    public function __construct($email, $create, $verificationUrl)
    {
        $this->email = $email;
        $this->create = $create;
        $this->verificationUrl = $verificationUrl;
    }


    public function handle()
    {
        Mail::to($this->email)->send(new WelcomeMail($this->create, $this->verificationUrl));
    }
}
