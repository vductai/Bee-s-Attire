<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\user_voucher;
use App\Models\Vouchers;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        user_voucher::create([
            'user_id' => $request->user_id,
            'voucher_id' => $request->voucher_id
        ]);

        return redirect()->back();

    }

    public function delete($id){
        user_voucher::where('user_voucher_id', $id)->delete();
        return redirect()->back();
    }
}
