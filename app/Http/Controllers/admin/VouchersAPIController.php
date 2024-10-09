<?php

namespace App\Http\Controllers\admin;

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

        $vouchers = Vouchers::query()->get();

        return response()->json([
            'message' => 'list',
            'data' => $vouchers
        ]);
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

        $start = $request->start_date;
        $end = $request->end_date;

        // convert date -> timestamp
        // dùng datetime local
        $start_date = Carbon::parse($start)->format('Y-m-d H:i:s');
        $end_date = Carbon::parse($end)->format('Y-m-d H:i:s');

        $voucher = Vouchers::create([
            'voucher_code' => $request->voucher_code,
            'voucher_price' => $request->voucher_price,
            'voucher_desc' => $request->voucher_desc,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'message' => 'add',
            'data' => $voucher
        ]);
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

    /**
     * Update the specified resource in storage.
     */
    public function update(VouchersRequest $request, string $id)
    {

        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $start = $request->start_date;
        $end = $request->end_date;

        // convert date -> timestamp
        $start_date = Carbon::parse($start)->format('Y-m-d H:i:s');
        $end_date = Carbon::parse($end)->format('Y-m-d H:i:s');

        $voucher = Vouchers::where('voucher_id', $id)->update([
            'voucher_code' => $request->voucher_code,
            'voucher_price' => $request->voucher_price,
            'start_date' => $start_date,
            'end_date' => $end_date
        ]);


        return response()->json([
            'message' => 'update',
            'data' => $voucher
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $voucher = Vouchers::findOrFail($id);
            $this->authorize('manageAdmin', Auth::user());
            $voucher->delete();
            return response()->json([
                'message' => 'Xóa thành công!',
                'data' => $voucher
            ]);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'Bạn không có quyền xóa voucher này!',
            ], 403);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Voucher không tồn tại!',
            ], 404);
        }
    }

}
