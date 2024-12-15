<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class user_voucher extends Model
{
    protected $table = 'user_voucher';
    protected $primaryKey = 'user_voucher_id';

    protected $fillable = [
        'user_id',
        'voucher_id',
        'end_date',
        'notified'
    ];

    public function voucher()
    {
        return $this->belongsTo(Vouchers::class, 'voucher_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
