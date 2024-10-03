<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
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
}
