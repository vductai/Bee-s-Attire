<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variant';
    protected $primaryKey = 'product_variant_id';
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
    ];


    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}