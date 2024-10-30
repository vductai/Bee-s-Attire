<?php

namespace App\Jobs;

use App\Mail\VoucherMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailVoucherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userEmail;
    protected $voucher;

    public function __construct($userEmail, $voucher)
    {
        $this->userEmail = $userEmail;
        $this->voucher = $voucher;
    }

    public function handle()
    {
        Mail::to($this->userEmail)->send(new VoucherMail($this->voucher));
    }
}
