<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class FindProductController extends Controller
{
    public function index(Request $request) {
        $searchTerm = $request->input('searchTerm');

        $products = Product::where('product_name', 'LIKE', '%' . $searchTerm . '%')->get();

        return response()->json($products);
    }
}
