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
        $totalAmount = Cart::where('user_id', $user->user_id)->sum(DB::raw('price'));

        // Kiểm tra nếu có mã giảm giá được nhập
        if($request->has('voucher_code') && !empty($request->voucher_code)){
        $voucher = Vouchers::where('voucher_code', $request->voucher_code)
            ->whereDate('end_date', '>=', now())
            ->first();

        // Nếu mã giảm giá không hợp lệ
        if(!$voucher){
            return back()->with('voucherError', 'Mã giảm giá không hợp lệ');
        }

        // Kiểm tra nếu số lượng voucher còn lại
        if($voucher->quantity <= 0){
            return back()->with('voucherError', 'Voucher đã hết lượt sử dụng');
        }

        // Tính toán giảm giá
        $voucher_item_id = $voucher->voucher_id;
        $discount = $totalAmount * ($voucher->voucher_price / 100);
        $total_after_discount = $totalAmount - $discount;

    } else {
        // Nếu không có voucher, tiếp tục với số tiền ban đầu
        $voucher_item_id = null;
        $discount = 0;
        $total_after_discount = $totalAmount;
    }

    return view('client.check-out', compact('selCart', 'totalAmount',
        'discount', 'total_after_discount', 'voucher_item_id'));
}


}
