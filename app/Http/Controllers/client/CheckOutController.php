<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckOutController extends Controller
{
    public function selectCart()
    {
        $user = auth()->user();
        $selCart = Cart::where('user_id', $user->user_id)->get();
        $totalAmount = Cart::where('user_id', $user->user_id)
            ->sum(DB::raw('price'));
        $discount = null;
        $voucher_item_id = null;
        $total_after_discount = $totalAmount;
        return view('client.check-out', compact('selCart', 'totalAmount', 'discount',
            'total_after_discount', 'voucher_item_id'));
    }

    public function applyVoucher(Request $request)
    {
        $user = auth()->user();
        $selCart = Cart::where('user_id', $user->user_id)->get();
        $totalAmount = Cart::where('user_id', $user->user_id)
            ->sum(DB::raw('price'));
        $voucher = Vouchers::where('voucher_code', $request->voucher_code)
            ->whereDate('end_date', '>=', now())
            ->first();

        // Kiểm tra xem voucher có hợp lệ không
        if (!$voucher) {
            return back()->with('voucherError', 'Mã giảm giá không hợp lệ');
        }

        // Kiểm tra nếu số lượng voucher > 0
        if ($voucher->quantity <= 0) {
            return back()->with('voucherError', 'Voucher đã hết lượt sử dụng');
        }

        // Tính toán giảm giá
        $voucher_item_id = $voucher->voucher_id;
        $total = $request->totalAmount;
        $discount = $total * ($voucher->voucher_price / 100);
        $total_after_discount = $total - $discount;

        /*// Trừ đi 1 từ tổng số lượng voucher
        $voucher->quantity -= 1;
        $voucher->save();*/

        return view('client.check-out', compact('selCart',
            'discount', 'total_after_discount',
            'totalAmount', 'voucher_item_id'));
    }

}
