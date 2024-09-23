<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vouchers extends Model
{
    use HasFactory;


    protected $table = 'vouchers';
    protected $primaryKey = 'voucher_id';

    protected $fillable = [
        'voucher_code',
        'voucher_price',
        'voucher_desc',
        'start_date',
        'end_date',
    ];

}
