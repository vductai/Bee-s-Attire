<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CheckOrderConfirmationMail extends Mailable
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
            subject: 'Thông báo xác nhận đã nhận được hàng',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.check-order-confirmation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
