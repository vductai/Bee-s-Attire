<?php

namespace App\Http\Controllers\client;

use App\Events\SearchDynamicEvent;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function index(Request $request){
        return Product::search($request->key);
    }
    public function searchProduct(Request $request)
    {
        $query = $request->input('key');

        $searchResults = Product::query()
            ->whereRaw("MATCH(product_name) AGAINST(? IN NATURAL LANGUAGE MODE)", [$query])
            ->orWhereHas('category', function ($q) use ($query){
                $q->where('category_name', 'LIKE', "%{$query}%")
                    ->orWhereHas('parent', function ($parentQuery) use ($query) {
                        $parentQuery->where('name', 'LIKE', "%{$query}%");
                    });
            })
            ->orWhereHas('tags', function ($q) use ($query){
                $q->where('tag_name', 'LIKE', "%{$query}%");
            })
            ->paginate(12);

        //return response()->json($searchResults);
        return view('client.search', compact('searchResults'));
    }

    public function searchDynamic(Request $request){
        $query = $request->input('key');

        $searchResults = Product::query()
            ->whereRaw("MATCH(product_name) AGAINST(? IN NATURAL LANGUAGE MODE)", [$query])
            ->orWhereHas('category', function ($q) use ($query){
                $q->where('category_name', 'LIKE', "%{$query}%")
                    ->orWhereHas('parent', function ($parentQuery) use ($query) {
                        $parentQuery->where('name', 'LIKE', "%{$query}%");
                    });
            })
            ->orWhereHas('tags', function ($q) use ($query){
                $q->where('tag_name', 'LIKE', "%{$query}%");
            })
            ->get();

        broadcast(new SearchDynamicEvent($searchResults));
        return response()->json($searchResults);
    }
}
