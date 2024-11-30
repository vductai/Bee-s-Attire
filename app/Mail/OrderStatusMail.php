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
        return new Envelope(
            subject: 'Trạng thái đơn hàng',
        );
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
