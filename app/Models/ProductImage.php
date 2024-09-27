<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';
    protected $primaryKey = 'product_image_id';
    protected $fillable = [
        'product_id',
        'product_image'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
