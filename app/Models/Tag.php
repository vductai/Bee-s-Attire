<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';
    protected $primaryKey = 'tag_id';

    protected $fillable = [
      'tag_name'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tag',
        'tag_id', 'product_id');
    }
}
