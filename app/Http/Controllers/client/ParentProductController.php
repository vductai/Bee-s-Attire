<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Parent_Category;

class ParentProductController extends Controller
{
    public function getProductParent($slug)
    {
        $get = Parent_Category::with('product')->where('slug',$slug)->first();
        $product = $get->product;
        return view('client.product.parent-product', compact('product'));
    }
}
