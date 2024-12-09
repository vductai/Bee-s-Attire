<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * @param $order
     */
    public function __construct($order)
    {
        $this->order = $order;
    }


    public function envelope(): Envelope
    {
        $subject = $this->getSubjectBasedOnStatus($this->order->status);
        return new Envelope(
            subject: $subject,
        );
    }
    private function getSubjectBasedOnStatus(string $status): string
    {
        switch ($status) {
            case 'Đã giao hàng':
                return "Đơn hàng có mã #{$this->order->order_id} của bạn đã được giao đi thành công";
            case 'Đã xác nhận':
                return "Đơn hàng có mã #{$this->order->order_id} của bạn đã được xác nhận";
            default:
                return 'Cập nhật trạng thái đơn hàng';
        }
    }
    public function content(): Content
    {
        return new Content(
            view: 'mail.order-status',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
