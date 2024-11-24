<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'order_id',
        'user_id',
        'total_price',
        'voucher_id',
        'final_price',
        'status',
        'payment_method',
        'note'
    ];

    public function order_item()
    {
        return $this->hasMany(order_item::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Vouchers::class, 'voucher_id');
    }
}