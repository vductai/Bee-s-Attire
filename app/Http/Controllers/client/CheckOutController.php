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
            ->sum(DB::raw('quantity * price'));
        return view('client.check-out', compact('selCart', 'totalAmount'));
    }

    public function applyVoucher(Request $request){
        $user = auth()->user();
        $selCart = Cart::where('user_id', $user->user_id)->get();
        $totalAmount = Cart::where('user_id', $user->user_id)
            ->sum(DB::raw('quantity * price'));
        $voucher = Vouchers::where('voucher_code', $request->voucher_code)
            ->whereDate('end_date', '>=', now())
            ->first();

        if (!$voucher){
            return back()->with('voucherError','Mã giảm giá không hợp hệ');
        }
        $total = $request->totalAmount;
        $discount = $total * ($voucher->voucher_price / 100);
        $total_after_discount = $total - $discount;

        return view('client.check-out', compact('selCart', 'discount', 'total_after_discount', 'totalAmount'));
    }
}
