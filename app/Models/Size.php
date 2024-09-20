<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;


    protected $table = 'sizes';
        // Chỉ định cột khóa chính
    protected $primaryKey = 'size_id';

    protected $fillable = [
        'size_name'
    ];


}






