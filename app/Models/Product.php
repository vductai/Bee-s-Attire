<?php

namespace App\Models;

use App\Http\Controllers\client\WishListController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchAspect;
use Spatie\Searchable\SearchResult;

class Product extends Model implements Searchable
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name',
        'product_avatar',
        'product_price',
        'product_desc',
        'sale_price',
        'category_id',
        'slug',
        'action',
        'views'
    ];

    public function getSearchResult():SearchResult
    {
        return new SearchResult(
          $this,
          $this->product_name,
          null
        );
    }

    public function featuredCategories()
    {
        return $this->belongsToMany(Featured_categories::class,
            'product_featured_category', 'product_id', 'featured_categories_id');
    }

    public function whishlists()
    {
        return $this->hasMany(Whishlist::class, 'product_id');
    }

    public function userWhishlist()
    {
        return $this->belongsToMany(User::class, 'whishlist',
            'product_id', 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag',
            'product_id', 'tag_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product_image(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class, 'product_id');
    }

    public function order_item(): HasMany
    {
        return $this->hasMany(order_item::class, 'product_id');
    }


}