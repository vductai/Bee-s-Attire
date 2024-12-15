<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{

    public function getCart()
    {
        $user = auth()->user();
        $getCart = Cart::where('user_id', $user->user_id)
            ->with(['productVariant', 'product'])
            ->get();
        return view('client.carts.cart', compact('getCart'));
    }


    public function addCart(Request $request)
    {
        if (!$request->has('product_variant_id') || empty($request->product_variant_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng chọn biến thể sản phẩm'
            ]);
            /*session()->put('errorCart', 'Vui lòng chọn biến thể sản phẩm');
            return back();*/
        }
        // lấy biến thể được chọn
        $variantQuantity = ProductVariant::where('product_variant_id', $request->product_variant_id)->first();

        $cartItem = Cart::where('product_variant_id', $request->product_variant_id)
            ->where('user_id', Auth::user()->user_id)->first();
        $sl = $request->quantity;
        // kiểm tra số lượng user nhập
        if ($sl > $variantQuantity->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Số lượng vượt quá kho'
            ]);
            /*session()->put('errorCart', 'Số lượng vượt quá kho');
            return back();*/
        } else if ($variantQuantity->quantity <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm đã hết hàng'
            ]);
            /*session()->put('errorCart', 'Sản phẩm đã hết hàng');
            return back();*/
        }

        // Nếu $cartItem đã tồn tại, cập nhật giỏ hàng
        if ($cartItem) {
            $cartItem->update([
                'quantity' => $request->quantity + $cartItem->quantity,
                'price' => ($request->sale_price * $request->quantity) + $cartItem->price
            ]);
        } else {
            // Nếu chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
            $cart = Cart::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'product_variant_id' => $request->product_variant_id,
                'price' => $request->sale_price * $request->quantity
            ]);
            return response()->json($cart);
        }

    }


    public function updateCart(Request $request)
    {
        $cartItems = $request->input('cartItems');
        foreach ($cartItems as $item) {
            $cartItem = Cart::where('product_variant_id', $item['idVariant'])
                ->where('user_id', Auth::user()->user_id)
                ->first();
            if ($cartItem) {
                $variant = ProductVariant::find($item['idVariant']);
                if ($variant->quantity < $item['quantity']) {
                    return response()->json([
                        'success' => false,
                        'message' => "{$variant->product->product_name} - {$variant->size->size_name}, {$variant->color->color_name}",
                        'variantQuantity' => "{$variant->quantity}"
                    ]);
                }
                $cartItem->quantity = $item['quantity'];
                $cartItem->price = $item['price'];
                $cartItem->update();
            }
        }
        return response()->json(['message' => 'done']);
    }

    public function deleteCart($id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'done']);
        }
    }

    public function deleteCartSlider($id)
    {
        $cartItem = Cart::find($id);

        if ($cartItem) {
            $cartItem->delete();
        }
        return redirect()->route('home');
    }

}
