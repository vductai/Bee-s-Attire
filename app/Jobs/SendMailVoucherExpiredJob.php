<?php

namespace App\Jobs;

use App\Mail\ExpiredVoucherMail;
use App\Models\User;
use App\Models\user_voucher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailVoucherExpiredJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Lấy ngày hết hạn là 3 ngày tới
        $day = now()->copy()->addDays(3);
        $expired = user_voucher::whereBetween('end_date', [now()->startOfDay(), $day])
            ->where('notified', false)
            ->get();
        if ($expired->isEmpty()){
            Log::info('No vouchers expiring in the next 3 days.');
            return;
        }
        $userVoucher = [];
        foreach ($expired as $voucher){
            $userVoucher[$voucher->user_id][] = $voucher;
        }
        foreach ($userVoucher as $userId => $vouchers){
            $userExpired = User::find($userId);
            if ($userExpired && $userExpired->email){
                Mail::to($userExpired->email)->send(new ExpiredVoucherMail($vouchers));
                foreach ($vouchers as $voucher) {
                    $voucher->notified = true;
                    $voucher->save();
                }
            }
        }
    }
}
