<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoucherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $voucher;
    public $action;

    /**
     * @param $voucher
     */
    public function __construct($voucher, $action)
    {
        $this->voucher = $voucher;
        $this->action = $action;
    }



    public function broadcastOn(): Channel
    {
        return ['vouchers'];
    }

    public function broadcastAs(){
        return 'voucher-updated';
    }
}
