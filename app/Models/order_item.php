<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class order_item extends Model
{
    protected $table = 'order_item';
    protected $primaryKey = 'order_item_id';
    protected $fillable = [
      'order_id',
      'product_id',
      'quantity',
      'price_per_item'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


}