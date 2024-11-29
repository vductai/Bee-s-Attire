<?php

namespace App\Jobs;

use App\Mail\RepContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RepContactJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $name;
    public $content;
    public $rep;

    /**
     * @param $name
     * @param $content
     * @param $rep
     */
    public function __construct($email, $name, $content, $rep)
    {
        $this->email = $email;
        $this->name = $name;
        $this->content = $content;
        $this->rep = $rep;
    }

    public function handle()
    {
        Mail::to($this->email)->send(new RepContactMail($this->name, $this->content, $this->rep));
    }
}
