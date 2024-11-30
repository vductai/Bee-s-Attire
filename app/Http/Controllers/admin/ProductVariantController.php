<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariantRequest;
use App\Http\Requests\VariantUpdateRequest;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
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
        return view('admin.variant.list-variant', compact('list'));
    }

    public function show($id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $show = ProductVariant::where('product_id', $id)->get();
        return response()->json([
            'message' => 'show',
            'data' => $show
        ]);
    }

    public function edit($id){
        $edit = ProductVariant::findOrFail($id);
        return response()->json([
            'idVariant' => $edit->product_variant_id,
            'color' => $edit->color->color_name,
            'size' => $edit->size->size_name,
            'quantity' => $edit->quantity
        ]);
    }

    public function create(){
        $product = Product::orderBy('created_at', 'desc')->get();
        $size = Size::orderBy('created_at', 'desc')->get();
        $color = Color::orderBy('created_at', 'desc')->get();
        $variant = ProductVariant::orderBy('created_at', 'desc')->get();
        return view('admin.variant.add-variant', compact('product', 'color', 'size', 'variant'));
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
            'data' => [
                'id' => $create->product_variant_id,
                'color' => $create->color->color_name,
                'size' => $create->size->size_name,
                'quantity' => $create->quantity,
                'productId' => $create->product_id
            ]
        ]);
    }

    public function update(VariantUpdateRequest $request, $id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $variant = ProductVariant::find($id);
        $variant->update([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id1,
            'size_id' => $request->size_id1,
            'quantity' => $request->quantity1
        ]);

        return response()->json([
            'data' => [
                'id' => $variant->product_variant_id,
                'color' => $variant->color->color_name,
                'size' => $variant->size->size_name,
                'quantity' => $variant->quantity,
                'productId' => $variant->product_id
            ]
        ]);

    }

    public function destroy($id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        ProductVariant::where('product_variant_id', $id)->delete();

        return response()->json(['message' => 'done']);
    }
}
