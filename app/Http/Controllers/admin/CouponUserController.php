<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailVoucherJob;
use App\Mail\VoucherMail;
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
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        foreach ($request->user_id as $index => $userId){
            $addVoucherUser = user_voucher::create([
                'user_id' => $userId,
                'voucher_id' => $request->voucher_id,
                'end_date' => Carbon::parse($request->end_date)->format('Y-m-d H:i:s')
            ]);
            $selEmail = User::where('user_id', $userId)->value('email');
            SendMailVoucherJob::dispatch($selEmail, $addVoucherUser);
        }
        return redirect()->back();
    }

    public function delete($id){
        user_voucher::where('user_voucher_id', $id)->delete();
        return redirect()->back();
    }
}
