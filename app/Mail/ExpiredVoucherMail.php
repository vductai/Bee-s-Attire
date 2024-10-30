<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExpiredVoucherMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vouchers;

    public function __construct($vouchers)
    {
        $this->vouchers = $vouchers;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Expired Voucher',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.expired-voucher',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
