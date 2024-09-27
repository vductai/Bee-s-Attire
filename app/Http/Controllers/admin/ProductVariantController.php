<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariantRequest;
use App\Models\ProductVariant;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class ProductVariantController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $list = ProductVariant::all();
        return response()->json([
            'message' => 'list',
            'data' => $list
        ]);
    }

    public function show($id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $show = ProductVariant::where('product_variant_id', $id)->get();
        return response()->json([
            'message' => 'show',
            'data' => $show
        ]);
    }

    public function store(ProductVariantRequest $request)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $create = ProductVariant::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'message' => 'add product variant',
            'data' => $create
        ]);
    }

    public function update(ProductVariantRequest $request, $id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $variant = ProductVariant::find($id);
        $variant->update([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'message' => 'update',
            'data' => $variant
        ]);

    }

    public function destroy($id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $delete = ProductVariant::where('product_variant_id', $id)->delete();
        return response()->json([
            'message' => 'delete',
            'data' => $delete
        ]);
    }
}
