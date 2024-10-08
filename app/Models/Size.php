<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    use HasFactory;


    protected $table = 'sizes';
    protected $primaryKey = 'size_id';
    protected $fillable = [
        'size_name'
    ];

<<<<<<< HEAD
=======

>>>>>>> 77f1927f19f4103550016ea09d4074270390cd8d
    public function variantSize(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'size_id');
    }


}






