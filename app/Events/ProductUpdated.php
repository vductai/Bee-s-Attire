<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProductUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;
    public $userId;
    public function __construct(Product $product,$userId)
    {
        $this->product = $product; 
        $this->userId = $userId;
    }

    public function broadcastOn()
    {
        Log::info('Broadcasting event for product: ' . $this->product->product_name);
        return new PrivateChannel('product.' . $this->userId);
    }

    public function broadcastAs()
    {
        return 'ProductUpdated';
    }
}

