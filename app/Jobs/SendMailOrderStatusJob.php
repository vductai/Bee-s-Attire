<?php

namespace App\Jobs;

use App\Mail\OrderStatusMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailOrderStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $order;

    /**
     * @param $email
     * @param $order
     */
    public function __construct($email, $order)
    {
        $this->email = $email;
        $this->order = $order;
    }


    public function handle()
    {
        Mail::to($this->email)->send(new OrderStatusMail($this->order));
    }
}
