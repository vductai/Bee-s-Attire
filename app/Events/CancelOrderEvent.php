<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CancelOrderEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    /**
     * @param $order
     */
    public function __construct($order)
    {
        $this->order = $order;
    }


    public function broadcastOn(): Channel
    {
        return new PrivateChannel('admin-cancel-order');
    }

    public function broadcastWith()
    {
        return [
            'order_id' => $this->order->order_id,
            'time' => Carbon::now(),
            'username' => $this->order->user->username,
            'message' => "Có yêu cầu hủy đơn hàng có ID: {$this->order->order_id} từ {$this->order->user->username}",
        ];
    }
}
