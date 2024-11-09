<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class VoucherExpiredNotification extends Notification
{
    use Queueable;

    protected $voucherId;
    protected $expiredAt;

    public function __construct($voucherId, $expiredAt)
    {
        $this->voucherId = $voucherId;
        $this->expiredAt = $expiredAt;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Voucher của bạn đã hết hạn và bị xóa',
            'voucher_id' => $this->voucherId,
            'expired_at' => $this->expiredAt,
        ];
    }
}
