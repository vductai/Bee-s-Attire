<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function searchProduct(Request $request)
    {
        $query = $request->input('key');

        $searchResults = (new Search())
            ->registerAspect(SearchQueryAspect::class)
            ->search($query);

        return response()->json($searchResults);
    }
}
