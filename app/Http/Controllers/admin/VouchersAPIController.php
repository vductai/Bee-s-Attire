<?php

namespace App\Http\Controllers\admin;

use App\Events\VoucherEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\VouchersRequest;
use App\Models\User;
use App\Models\Vouchers;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VouchersAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $vouchers = Vouchers::all();

        return view('admin.voucher.add-voucher', compact('vouchers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VouchersRequest $request)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        /*$start = $request->start_date;
        $end = $request->end_date;
        // convert date -> timestamp
        // dùng datetime local
        $start_date = Carbon::parse($start)->format('Y-m-d H:i:s');
        $end_date = Carbon::parse($end)->format('Y-m-d H:i:s');*/
        if ($request->voucher_price > 100){
            return response()->json([
                'success' => false,
                'message' => 'Không được vượt quá 100 %'
            ]);
        }
        $add = Vouchers::create([
            'voucher_code' => $request->voucher_code,
            'voucher_price' => $request->voucher_price,
            //'quantity' => $request->quantity,
            'voucher_desc' => $request->voucher_desc,
            'max_discount' => $request->max_discount,
            //'start_date' => $start_date,
            //'end_date' => $end_date,
        ]);
        return response()->json($add);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $vouchers = Vouchers::query()->findOrFail($id );
        return response()->json([
            'message' => 'show',
            'data' => $vouchers
        ]);
    }

    public function edit($id){
        $find = Vouchers::findOrFail($id);
        $vouchers = Vouchers::all();
        return view('admin.voucher.update-voucher',compact('vouchers', 'find'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VouchersRequest $request,$id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        /*$start = $request->start_date;
        $end = $request->end_date;
        // convert date -> timestamp
        $start_date = Carbon::parse($start)->format('Y-m-d H:i:s');
        $end_date = Carbon::parse($end)->format('Y-m-d H:i:s');*/
        $voucher = Vouchers::findOrFail($id);
        $voucher->update([
            'voucher_code' => $request->voucher_code,
            'voucher_price' => $request->voucher_price,
            'voucher_desc' => $request->voucher_desc,
            'max_discount' => $request->max_discount,
            /*'start_date' => $start_date,
            'end_date' => $end_date*/
        ]);
        return response()->json($voucher);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $voucher = Vouchers::find($id);
        $relatedDataExists = $voucher->user_voucher()->exists();
        if ($relatedDataExists) {
            return response()->json(['message' => 'Voucher này đang được sử dụng và không thể xóa.'], 400);
        }
        $voucher->delete(); // Xóa voucher nếu không có liên kết
        return response()->json(['message' => 'Xóa thành công!']);
    }

}
