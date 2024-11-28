<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteVoucherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $voucherName;
    public $message;

    /**
     * @param $userId
     * @param $voucherName
     * @param $message
     */
    public function __construct($userId, $voucherName, $message)
    {
        $this->userId = $userId;
        $this->voucherName = $voucherName;
        $this->message = $message;
    }


    public function broadcastOn(): Channel
    {
        return new PrivateChannel("user.{$this->userId}");
    }
}
