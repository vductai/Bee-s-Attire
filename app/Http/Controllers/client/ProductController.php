<?php
//
//namespace App\Http\Controllers\client;
//
//use App\Http\Controllers\Controller;
//use App\Models\Banner;
//use App\Models\Category;
//use App\Models\Color;
//use App\Models\Product;
//use App\Models\Size;
//use Illuminate\Http\Request;
//
//class ProductController extends Controller
//{
//    public function index()
//    {
//        $list = Product::all();
//        return response()->json([
//            'message' => 'list',
//            'data' => $list
//        ]);
//    }
//
//
//    public function listAllProductMain(Request $request)
//    {
//        $listAllCategory = Category::all();
//        $banners = Banner::all();
//
//        $category_id = $request->get('category_id', 'all');
//        if ($category_id === 'all') {
//            $listAllProduct = Product::all();
//        } else {
//            $listAllProduct = Product::where('category_id', $category_id)->get();
//        }
//
//        return view('client.main', compact('listAllProduct', 'listAllCategory', 'category_id', 'banners'));
//    }
//
//
//    public function getProductDetail($slug)
//    {
//        $getDetail = Product::where('slug', $slug)->first();
//        return view('client.product.detail-product', compact('getDetail'));
//    }
//
//
//    // list product shop
//
//    public function getProductShop(Request $request)
//    {
//        $category_id = $request->get('category_id', 'all');
//
//        $listcategory = Category::withCount('product')->get();
//        if ($category_id === 'all'){
//            $listAllProductShop = Product::all();
//        }else{
//            $listAllProductShop = Product::where('category_id', $category_id)->get();
//        }
//        $listColor = Color::all();
//        $listSize = Size::all();
//        return view('client.product.show-product', compact('listAllProductShop',
//            'listcategory', 'listSize', 'listColor'));
//    }
//
//
//}
