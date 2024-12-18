<?php

namespace App\Jobs;

use App\Mail\CheckOrderConfirmationMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CheckOrderConfirmationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;


    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    public function handle()
    {
        $order = $this->order->fresh(); // lấy trạng thái mới của đơn hàng
        if ($order->status === 'Đã giao hàng'){
            Mail::to($order->user->email)->send(new CheckOrderConfirmationMail($order));
        }
    }
}
