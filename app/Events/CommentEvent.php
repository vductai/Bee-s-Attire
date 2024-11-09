<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $commentData;

    public function __construct($commentData)
    {
        $this->commentData = [
            'comment' => $commentData->comment,
            'user' => [
                'username' => $commentData->user->username,
                'avatar' => $commentData->user->avatar,
            ],
            'product_id' => $commentData->product_id,
            'created_at' => $commentData->created_at,
        ];
    }

    public function broadcastOn(): Channel
    {
        return new Channel('product-comments');
    }

    public function broadcastWith()
    {
        return $this->commentData;
    }
}
