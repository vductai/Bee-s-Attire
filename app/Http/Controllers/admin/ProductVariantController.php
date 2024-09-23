<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariantRequest;
use App\Models\ProductVariant;

class ProductVariantController extends Controller
{
    public function index()
    {

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
}
