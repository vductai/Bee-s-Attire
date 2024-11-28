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
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $list = ProductVariant::with('product', 'color', 'size')->get();
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
    public function create()
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        return view('admin.variant.add-variant');
    }
    public function store(Request $request)
    {
 
            $request->validate([
                'product_name' => 'required',
                'color_code' => 'required',
                'size_name' => 'required',
                'quantity' => 'required',
            ]);
    
            $product = Product::where('product_name', $request->product_name)->first();
            $color = Color::where('color_code', $request->color_code)->first();
            $size = Size::where('size_name', $request->size_name)->first();
            
            $variant = ProductVariant::create([
                'product_id' => $product->id,
                'color_id' => $color->id,
                'size_id' => $size->id,
                'quantity' => $request->quantity,
            ]);
    
            return response()->json($variant);
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
