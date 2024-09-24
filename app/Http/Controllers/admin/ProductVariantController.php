<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariantRequest;
use App\Models\ProductVariant;

class ProductVariantController extends Controller
{
    public function index()
    {
        $list = ProductVariant::all();
        return response()->json([
            'message' => 'list',
            'data' => $list
        ]);
    }

    public function show($id){
        $show = ProductVariant::where('product_variant_id', $id)->get();
        return response()->json([
            'message' => 'show',
            'data' => $show
        ]);
    }

    public function store(ProductVariantRequest $request)
    {
        $create = ProductVariant::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
        ]);

        return response()->json([
            'message' => 'add product variant',
            'data' => $create
        ]);
    }

    public function update(ProductVariantRequest $request, $id){
        $variant = ProductVariant::find($id);
        $variant->update([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
        ]);

        return response()->json([
            'message' => 'update',
            'data' => $variant
        ]);

    }

    public function destroy($id){
        $delete = ProductVariant::where('product_variant_id', $id)->delete();
        return response()->json([
            'message' => 'delete',
            'data' => $delete
        ]);
    }
}
