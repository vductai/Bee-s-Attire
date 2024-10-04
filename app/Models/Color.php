<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';
    protected $primaryKey = 'color_id';
    protected $fillable = [
        'color_name',
        'color_code'
    ];


    public function variantColor(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'color_id');
    }

}
