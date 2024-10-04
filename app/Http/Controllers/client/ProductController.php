<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
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


    public function listAllProductMain(){
        $listAllCategory = Category::all();
        $listAllProduct = Product::all();
        return view('client.main', compact('listAllProduct', 'listAllCategory'));
    }

    public function getProductDetail($id){
        $getDetail = Product::findOrFail($id);
        return view('client.product.detail-product', compact('getDetail'));
    }

}
