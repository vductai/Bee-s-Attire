<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ColorEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $color;
    public $active;


    public function __construct($color, $active)
    {
        $this->color = $color;
        $this->active = $active;
    }


    public function broadcastOn(): Channel
    {
        return ['colors'];
    }

    public function broadcastAs(){
        return 'color-updated';
    }
}
