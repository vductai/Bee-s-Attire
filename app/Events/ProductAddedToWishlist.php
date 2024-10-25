<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductAddedToWishlist implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function broadcastOn()
    {

        return new Channel('wishlist.' . $this->userId);
    }

    public function broadcastAs()
    {
        return 'product-added';
    }
}

