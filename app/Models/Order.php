<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    protected $fillable = [
      'user_id',
      'total_price',
      'voucher_id',
      'final_price'
    ];

    public function order_item()
    {
        return $this->hasMany(order_item::class, 'order_id');
    }
}
