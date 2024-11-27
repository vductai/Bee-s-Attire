<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RepContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $content;
    public $rep;

    /**
     * @param $name
     * @param $content
     * @param $rep
     */
    public function __construct($name, $content, $rep)
    {
        $this->name = $name;
        $this->content = $content;
        $this->rep = $rep;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Trả lời câu hỏi của khách hàng',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.rep-contact',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
