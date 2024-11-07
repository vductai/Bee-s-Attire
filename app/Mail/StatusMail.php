<?php
namespace App\Mail;

use App\Models\Status;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $status;

    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject('Trạng thái của bạn đã thay đổi')
                    ->view('emails.status_update')
                    ->with('status', $this->status);
    }
}


?>