<?php

namespace App\Http\Controllers\client;
use App\Models\Product;
use Illuminate\Support\Collection;
use Spatie\Searchable\SearchAspect;

class SearchQueryAspect extends SearchAspect
{

    public function getResults(string $term): Collection
    {
        return Product::query()
            ->whereRaw("MATCH(product_name) AGAINST(? IN NATURAL LANGUAGE MODE)", [$term])
            ->orWhereHas('category', function ($query) use ($term){
                $query->where('category_name', 'LIKE', "%{$term}%")
                    ->orWhereHas('parent', function ($parentQuery) use ($term) {
                        $parentQuery->where('name', 'LIKE', "%{$term}%");
                    });
            })
            ->orWhereHas('tags', function ($query) use ($term){
                $query->where('tag_name', 'LIKE', "%{$term}%");
            })
            ->get();
    }
}
