<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_featured_category extends Model
{
    protected $table = 'product_featured_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'featured_categories_id'
    ];
}
