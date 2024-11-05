<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Featured_categories extends Model
{
    protected $table = 'featured_categories';
    protected $primaryKey = 'featured_categories_id';
    protected $fillable = [
        'featured_categories_name'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_featured_category',
            'featured_categories_id', 'product_id');
    }
}
