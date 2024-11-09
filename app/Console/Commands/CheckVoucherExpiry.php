<?php

namespace App\Console\Commands;

use App\Models\user_voucher;
use Illuminate\Console\Command;
use App\Notifications\VoucherExpiredNotification;
use Carbon\Carbon;

class CheckVoucherExpiry extends Command
{
    protected $signature = 'app:check-voucher-expiry';
    protected $description = 'Check and delete expired vouchers, then create notifications for users';

    public function handle()
    {
        $expiredVouchers = user_voucher::where('end_date', '<', Carbon::now())->get();

        foreach ($expiredVouchers as $voucher) {
            // Gửi notification cho user khi voucher hết hạn
            $voucher->user->notify(new VoucherExpiredNotification($voucher->voucher_id, $voucher->end_date));

            // Xóa voucher đã hết hạn
            $voucher->delete();
        }

        $this->info('Expired vouchers checked and deleted, notifications created.');
    }
}
