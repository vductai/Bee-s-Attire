<?php

namespace App\Http\Controllers\admin;

use App\Events\VoucherAssignedEvent;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailVoucherJob;
use App\Mail\VoucherMail;
use App\Models\Notifications;
use App\Models\User;
use App\Models\user_voucher;
use App\Models\Vouchers;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CouponUserController extends Controller
{
    public function formAdd()
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $user = User::all();
        $voucher = Vouchers::all();
        $list = user_voucher::all();
        return view('admin.voucher.add-voucher-user', compact('user', 'voucher', 'list'));
    }

    public function store(Request $request){
        try {
            $this->authorize(    'manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $request->validate([
            'user_id' => ['required'],
            'voucher_id' => ['required'],
            'end_date' => ['required']
        ],[
            'user_id' => 'Vui lòng nhập',
            'voucher_id' => 'Vui lòng nhập',
            'end_date' => ' Vui lòng nhập',
        ]);
        $endDate = Carbon::parse($request->end_date)->startOfDay();
        $now = Carbon::now()->startOfDay(); // chỉ lấy ngày
        if ($endDate->equalTo($now)) {
            return response()->json([
                'success' => false,
                'message' => 'Ngày hết hạn không được trùng với ngày hiện tại'
            ]);
        }
        if ($endDate->lessThanOrEqualTo($now)){
            return response()->json([
                'success' => false,
                'message' => 'Ngày hết hạn không phù hợp'
            ]);
        }
        $voucher = Vouchers::find($request->voucher_id);
        foreach ($request->user_id as $index => $userId){
            $addVoucherUser = user_voucher::create([
                'user_id' => $userId,
                'voucher_id' => $request->voucher_id,
                'end_date' => Carbon::parse($request->end_date)->format('Y-m-d H:i:s')
            ]);
            $user = User::find($userId);
            Notifications::create([
                'user_id' => $userId,
                'message' => "Bạn vừa nhận được mã giảm giá {$voucher->voucher_price} %, hãy mua sắm ngay để tiếp kiệm nhiều hơn"
            ]);
            broadcast(new VoucherAssignedEvent($user, $voucher, $addVoucherUser->end_date));
            $selEmail = User::where('user_id', $userId)->value('email');
            SendMailVoucherJob::dispatch($selEmail, $addVoucherUser);
        }
        return response()->json(['message' => 'done']);
    }

    public function delete($id){
        user_voucher::where('user_voucher_id', $id)->delete();
        return redirect()->back();
    }
}
