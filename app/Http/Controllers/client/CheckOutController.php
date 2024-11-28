<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\user_voucher;
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
        if ($request->has('voucher_code') && !empty($request->voucher_code)) {
            // Tìm mã giảm giá trong bảng user_voucher cho người dùng hiện tại
            $voucher = user_voucher::where('user_id', $user->user_id)
                ->where('end_date', '>=', now()) // Kiểm tra end_date trong bảng user_voucher
                ->whereHas('voucher', function ($query) use ($request) {
                    $query->where('voucher_code', $request->voucher_code);
                })
                ->first();
            // Nếu mã giảm giá không hợp lệ
            if (!$voucher) {
                session()->put('voucherError', 'Mã giảm giá không hợp lệ');
                return back();
            }
            $voucher_item_id = $voucher->voucher->voucher_id;
            // Tính toán giảm giá
            $discount = $totalAmount * ($voucher->voucher->voucher_price / 100);
            $total_after_discount = $totalAmount - $discount;
        } else {
            // Nếu không có voucher, tiếp tục với số tiền ban đầu
            $voucher_item_id = null;
            $discount = 0;
            $total_after_discount = $totalAmount;
        }
        return view('client.check-out', compact('selCart', 'totalAmount',
            'discount', 'total_after_discount', 'voucher_item_id', 'voucher'));
    }
}