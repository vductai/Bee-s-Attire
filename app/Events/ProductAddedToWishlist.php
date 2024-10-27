<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductAddedToWishlist implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;
    public $productName;
    public $userId;
    public $productId; 
    public $action; 

    public function __construct($userId, $username, $productName, $productId, $action)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->productName = $productName;
        $this->productId = $productId;
        $this->action = $action;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('wishlist.' . $this->userId);
    }

    public function broadcastAs()
    {
        return 'ProductUpdated'; 
    }
}
