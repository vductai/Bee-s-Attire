<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VouchersRequest;
use App\Http\Resources\VouchersResource;
use App\Models\Vouchers;
use Illuminate\Http\Request;

class VouchersAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Vouchers::query()->get();

        return VouchersResource::collection(resource: $vouchers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VouchersRequest $request)
    {
        $param = $request->all();

        $vouchers = Vouchers::create($param);

        return response()->json([
            'data' => new VouchersResource(resource: $vouchers),

            'message' => 'Them moi thanh cong!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vocuchers = Vouchers::query()->findOrFail($id );
        
        return new VouchersResource($vocuchers);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vocuchers = Vouchers::query()->findOrFail($id);

        $param = $request->all();

        $vocuchers->update($param);

        return response()->json([
            'data' => new VouchersResource($vocuchers),
            'message' => 'Sửa vouchers thành công!',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vocuchers = Vouchers::query()->findOrFail($id );

        $vocuchers->delete();

        return response()->json([
            
            'message' => 'Xoa thanh cong !',
        ]);
    }
}
