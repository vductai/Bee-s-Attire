<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
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
            subject: 'Đặt hàng thành công',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.Order',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
