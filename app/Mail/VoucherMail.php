<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VoucherMail extends Mailable
{
    use Queueable, SerializesModels;

    public $voucher;

    public function __construct($voucher)
    {
        $this->voucher = $voucher;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Chúc mừng! Bạn vừa nhận được voucher giảm giá đặc biệt 🎉',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.voucher',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
