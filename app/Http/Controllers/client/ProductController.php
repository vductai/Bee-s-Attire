<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Tag;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $list = Product::all();
        return response()->json([
            'message' => 'list',
            'data' => $list
        ]);
    }


    public function listAllProductMain(Request $request)
    {
        $listAllCategory = Category::all();
        $banners = Banner::all();
        
        $category_id = $request->get('category_id', 'all');
        if ($category_id === 'all') {
            $listAllProduct = Product::all();
        } else {
            $listAllProduct = Product::where('category_id', $category_id)->get();
        }
        $userId = Auth::id();
        
        $wishlistProducts = Wishlist::where('user_id', $userId)->pluck('product_id')->toArray();
        
        return view('client.main', compact('listAllProduct', 'listAllCategory', 'category_id', 'banners', 'wishlistProducts'));
    }

    // list product shop

    public function getProductShop(Request $request)
    {
        $category_id = $request->get('category_id', 'all');

        $listcategory = Category::withCount('product')->get();
        if ($category_id === 'all'){
            $listAllProductShop = Product::where('action', '=', 1)->get();
        }else{
            $listAllProductShop = Product::where('category_id', $category_id)->where('action', '=', 1)->get();
        }
        $listColor = Color::all();
        $listSize = Size::all();
        return view('client.product.show-product', compact('listAllProductShop',
            'listcategory', 'listSize', 'listColor'));
    }

    public function searchTag(Request $request)
    {
        $searchTerm = $request->input('query');
        $tags = Tag::where('tag_name', 'like', '%' . $searchTerm . '%')->get();

        return response()->json($tags);
    }
}
