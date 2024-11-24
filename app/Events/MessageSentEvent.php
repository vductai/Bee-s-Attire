<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $receiverId;
    public $senderId;
    public $senderInfo;
    /**
     * @param $message
     * @param $receiverId
     * @param $senderId
     */
    public function __construct($message, $receiverId, $senderId)
    {
        $this->message = $message;
        $this->receiverId = $receiverId;
        $this->senderId = $senderId;
        $this->senderInfo = User::find($senderId);
    }


    public function broadcastOn(): Channel
    {
        return new PrivateChannel('chat.' . $this->message->receiver_id);
    }
    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'receiverId' => $this->receiverId,
            'senderId' => $this->senderId,
            'senderInfo' => [
                'id' => $this->senderInfo->user_id,
                'name' => $this->senderInfo->username,
                'email' => $this->senderInfo->email,
                'avatar' => $this->senderInfo->avatar
            ]
        ];
    }
}
