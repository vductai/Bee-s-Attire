<?php

namespace App\Jobs;

use App\Events\DeleteVoucherEvent;
use App\Models\Notifications;
use App\Models\User;
use App\Models\user_voucher;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DeleteVoucherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $endVoucher = user_voucher::whereDate('end_date', '=', Carbon::today())->get();
        foreach ($endVoucher as $item) {
            $voucherName = $item->voucher->voucher_code;
            $userId = $item->user_id;
            $item->delete();
            $noti = Notifications::create([
                'user_id' => $userId,
                'message' => "Mã giảm giá {$voucherName} đã xoá do hết hạn"
            ]);
            $message = $noti->message;
            broadcast(new DeleteVoucherEvent($userId, $voucherName, $message));
        }
    }
}
