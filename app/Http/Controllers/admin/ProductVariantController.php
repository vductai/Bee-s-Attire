<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariantRequest;
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
        $show = ProductVariant::findOrFail($id);
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

        $create->load(['color', 'size']);

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
            'product_id' => $variant->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity
        ]);
        $variant->load(['color', 'size']);

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

        return redirect()->route('product-variant.index');
    }
}
