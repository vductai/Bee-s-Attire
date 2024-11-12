<?php

namespace App\Events;

use App\Models\User;
use App\Models\Vouchers;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoucherAssignedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $voucher;
    public $userId;
    public $endDate;

    public function __construct(User $user, Vouchers $voucher, $endDate)
    {
        $this->userId = $user->user_id;
        $this->voucher = $voucher;
        $this->endDate = $endDate;
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel("user.{$this->userId}");
    }
}
