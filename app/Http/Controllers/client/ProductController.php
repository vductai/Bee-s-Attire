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
}
