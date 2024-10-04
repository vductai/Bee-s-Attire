<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function getCart(){
        $user = auth()->user();
        $getCart = Cart::where('user_id', $user->user_id)->with(['productVariant', 'product'])->get();
        return view('client.carts.cart', compact('getCart'));
    }

    public function getCartSlider(){
        $user = auth()->user();
        $getCartSlider = Cart::where('user_id', $user->user_id)->with(['productVariant', 'product'])->get();
        return view('layout.client.footer', ['getCartSlider' => $getCartSlider]);
    }


    public function addCart(Request $request)
    {
        $request->all();
        Cart::create([
            'user_id' =>$request->user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'product_variant_id' => $request->product_variant_id,
            'price' => $request->sale_price * $request->quantity
        ]);
        return redirect()->route('viewCart');
    }

    public function deleteCart($id){
        $user = auth()->user();
        $cartItem = Cart::where('user_id', $user->user_id)->where('cart_item_id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
        }
        return redirect()->route('viewCart');
    }

}
