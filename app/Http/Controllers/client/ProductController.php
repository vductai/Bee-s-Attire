<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
<<<<<<< Updated upstream
=======
use App\Models\Banner;
use App\Models\Category;
use App\Models\Color;
>>>>>>> Stashed changes
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $list =  Product::all();
        return response()->json([
           'message' => 'list',
           'data' => $list
        ]);
    }

<<<<<<< Updated upstream

    public function showDetailProduct(){

    }
    public function store(Request $request)
{
    $request->validate([
        'product_name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'sale_price' => 'nullable|numeric|min:0',
        'desc' => 'required|string',
        'main_image' => 'required|image|mimes:jpg,jpeg,png|max:2048', 
    ]);
}
=======
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
    
        return view('client.main', compact('listAllProduct', 'listAllCategory', 'category_id', 'banners'));
    }

    public function getProductDetail($slug)
    {
        $getDetail = Product::where('slug', $slug)->first();
        return view('client.product.detail-product', compact('getDetail'));
    }

    // list product shop
    public function getProductShop(Request $request)
    {
        // Lấy danh sách category, màu sắc và kích thước
        $listcategory = Category::withCount('product')->get();
        $listColor = Color::all();
        $listSize = Size::all();

        // Khởi tạo truy vấn sản phẩm
        $query = Product::with(['variants.color', 'variants.size']);

        // Lọc theo category
        $category_id = $request->get('category_id', 'all');
        if ($category_id !== 'all') {
            $query->where('category_id', $category_id);
        }

        // Lọc sản phẩm theo màu sắc
        if ($request->has('colors') && !empty($request->colors)) {
            $query->whereHas('variants', function($q) use ($request) {
                $q->whereIn('color_id', $request->input('colors'));
            });
        }

        // Lọc sản phẩm theo kích thước
        if ($request->has('sizes') && !empty($request->sizes)) {
            $query->whereHas('variants', function($q) use ($request) {
                $q->whereIn('size_id', $request->input('sizes'));
            });
        }

        // Lọc sản phẩm theo giá
        if ($request->has('price_min') && $request->has('price_max')) {
            $priceMin = $request->input('price_min');
            $priceMax = $request->input('price_max');
            $query->whereBetween('sale_price', [$priceMin, $priceMax]);
        }

        // Lấy sản phẩm
        $listAllProductShop = $query->paginate(10);
        return view('client.product.show-product', compact('listAllProductShop', 'listcategory', 'listSize', 'listColor'));
    }
>>>>>>> Stashed changes
}
