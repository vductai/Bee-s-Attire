<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    use HasFactory;

    
    protected $table = 'vouchers';

    protected $fillable = [
        'voucher_name',
        'voucher_code',
        'voucher_price',
        'start_date',
        'end_date',
    ];
}
