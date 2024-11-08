<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Color;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;
use function PhpOffice\PhpSpreadsheet\Cell\AddressHelper;

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

        $category_id = $request->get('category_id', 'all');
        if ($category_id === 'all') {
            $listAllProduct = Product::where('action', '=', 1)->get();
        } else {
            $listAllProduct = Product::where('category_id', $category_id)->where('action', '=', 1)->get();
        }

        return view('client.main', compact('listAllProduct', 'listAllCategory', 'category_id'));
    }


    public function getProductDetail($slug)
    {
        session(['url.intended' => url()->current()]);
        $getDetail = Product::where('slug', $slug)->first();
        $id = $getDetail->product_id;
        // tăng lượt xem
        $productKey = 'product_' . $id;
        if (!session()->has($productKey)){
            $getDetail->increment('views');
            session([$productKey => true]);
        }
        $listPost = Comment::where('product_id', $id)->get();
        return view('client.product.detail-product', compact('getDetail', 'listPost'));
    }


    // list product shop
    public function getProductShop()
    {
        $listcategory = Category::withCount('product')->get();
        $listAllProductShop = Product::where('action', '=', 1)->get();
        $listColor = Color::all();
        $listSize = Size::all();
        $tags = Tag::all();
        $priceRange = Product::selectRaw('MIN(sale_price) as min_price, MAX(sale_price) as max_price')->first();
        $lowestPrice = $priceRange->min_price;
        $highestPrice = $priceRange->max_price;
        return view('client.product.show-product', compact('listAllProductShop',
            'listcategory', 'listSize', 'listColor', 'tags', 'lowestPrice', 'highestPrice'));
    }

    public function search(Request $request){
        $categories = $request->input('categories', []);
        $colors = $request->input('colors', []);
        $sizes = $request->input('sizes', []);
        // Lấy ProductVariant cùng với thông tin Product và Category
        $query = ProductVariant::with('product.category');

        if (empty($categories) && empty($colors) && empty($sizes)){
            $products = Product::with('category')->get();
            return response()->json([
                'products' => $products
            ]);
        }else{
            if (!empty($categories)) {
                $query->whereHas('product.category', function ($q) use ($categories) {
                    $categoryIds = Category::whereIn('category_name', $categories)->pluck('category_id')->toArray();
                    $q->whereIn('category_id', $categoryIds);
                });
            }
            if (!empty($colors)) {
                $colorIds = Color::whereIn('color_name', $colors)->pluck('color_id')->toArray();
                $query->whereIn('color_id', $colorIds);
            }
            if (!empty($sizes)) {
                $sizeIds = Size::whereIn('size_name', $sizes)->pluck('size_id')->toArray();
                $query->whereIn('size_id', $sizeIds);
            }
            $productVariants = $query->get();
        }
        // Lấy danh sách sản phẩm duy nhất với thông tin danh mục
        $products = $productVariants->map(function ($variant) {
            return $variant->product;
        })->unique('product_id');
        return response()->json([
            'products' =>  $products
        ]);
    }

    public function filterPrice(Request $request){
        $min = $request->input('min_price');
        $max = $request->input('max_price');
        function convert($price){
            $price = str_replace([' đ', '.'], '', $price);
            // chuyển đổi sang số nguyên
            return intval($price);
        }
        $minPrice = convert($min);
        $maxPrice = convert($max);
        $filter = Product::whereBetween('sale_price', [$minPrice, $maxPrice])
            ->with('category')->get();
        return response()->json($filter);
    }

    public function searchTag(Request $request)
    {
        $searchTerm = $request->input('query');
        $tags = Tag::where('tag_name', 'like', '%' . $searchTerm . '%')->get();
        return response()->json($tags);
    }
}
