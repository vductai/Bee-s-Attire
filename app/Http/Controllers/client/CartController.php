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
        $getCart = Cart::where('user_id', $user->user_id)->with(['productVariant', 'product'])->get();
        return view('client.carts.cart', compact('getCart'));
    }


    public function addCart(Request $request)
    {
        $request->all();
        // lấy biến thể được chọn
        $variantQuantity = ProductVariant::where('product_variant_id', $request->product_variant_id)->first();

        $cartItem = Cart::where('product_variant_id', $request->product_variant_id)
            ->where('user_id', Auth::user()->user_id)->first();
        $sl = $request->quantity;
        // kiểm tra số lượng user nhập
        if ($sl > $variantQuantity->quantity) {
            session()->put('errorCart', 'Số lượng vượt quá kho');
            return back();
        } else if ($variantQuantity->quantity <= 0) {
            session()->put('errorCart', 'Sản phẩm đã hết hàng');
            return back();
        }

        // Nếu $cartItem đã tồn tại, cập nhật giỏ hàng
        if ($cartItem) {
            $cartItem->update([
                'quantity' => $request->quantity + $cartItem->quantity,
                'price' => ($request->sale_price * $request->quantity) + $cartItem->price
            ]);
        } else {
            // Nếu chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
            Cart::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'product_variant_id' => $request->product_variant_id,
                'price' => $request->sale_price * $request->quantity
            ]);
            /*// update sl sau
            $variantQuantity->quantity -= $request->quantity;
            $variantQuantity->update();*/
        }
        return redirect()->route('viewCart');
    }


    public function updateCart(Request $request)
    {
        $cartItems = $request->input('cartItems');

        foreach ($cartItems as $item) {
            $cartItem = Cart::where('product_id', $item['product_id'])->where('user_id', Auth::user()->user_id)->first();
            if ($cartItem) {
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
            return redirect()->back();
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