<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LockUserAccountEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;

    /**
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }


    public function broadcastOn(): Channel
    {
        return new PrivateChannel('lock-acc.' . $this->userId);
    }
}
