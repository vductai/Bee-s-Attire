<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SearchDynamicEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $serults;

    /**
     * @param $serults
     */
    public function __construct($serults)
    {
        $this->serults = $serults;
    }


    public function broadcastOn(): Channel
    {
        return new Channel('search-dynamic');
    }
}
