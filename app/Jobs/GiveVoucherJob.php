<?php

namespace App\Jobs;

use App\Events\GiveVoucherEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GiveVoucherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userId;

    /**
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }


    public function handle()
    {
        broadcast(new GiveVoucherEvent($this->userId));
    }
}
