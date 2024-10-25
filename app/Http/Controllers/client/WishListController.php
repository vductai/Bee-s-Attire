<?php

namespace App\Http\Controllers\Client;

use App\Events\ProductAddedToWishlist;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class WishListController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $wishlists = Wishlist::where('user_id', $userId)->with('product')->get();

        return view('client.wish-list', compact('wishlists'));
    }

    public function addToWishlist(Request $request)
    {
        $userId = Auth::id();
        $existingWishlistItem = Wishlist::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingWishlistItem) {
            return redirect()->back()->with('message', 'Sản phẩm đã có trong wishlist.');
        }

        $wishlist = new Wishlist();
        $wishlist->user_id = $userId;
        $wishlist->product_id = $request->product_id;
        $wishlist->save();

        event(new ProductAddedToWishlist($userId, $request->product_id));

        return redirect()->route('list-wish')->with('message', 'Sản phẩm được thêm vào wishlist thành công.');
    }


    public function deleteWishlist($id)
    {
        $userId = Auth::id();

        $wishlistItem = Wishlist::where('user_id', $userId)
            ->where('product_id', $id)
            ->first();

        $wishlistItem->delete();

        return redirect()->back()->with('message', 'Sản phẩm đã bị xóa khỏi wishlist.');
    }
}
