<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function searchProduct(Request $request)
    {
        $query = $request->input('key');

        $results = Product::where(function($q) use ($query) {
            $q->where('product_name', 'LIKE', "%{$query}%")
                ->orWhere('product_price', 'LIKE', "%{$query}%");
        })
            ->orWhereHas('variants.color', function($query_color) use ($query) {
                $query_color->where('color_name', $query);
            })
            ->get();

        if ($results->isNotEmpty()) {
            return response()->json([
                'message' => 'search',
                'data' => $results
            ]);
        }

        return response()->json([
            'message' => 'search no data'
        ]);
    }


}
