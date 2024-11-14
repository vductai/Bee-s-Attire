<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parent_Category extends Model
{
    use HasFactory;
    protected $table = 'parent_category';
    protected $fillable = [
        'name',
        'slug'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'id');
    }

    public function product()
    {
        return $this->hasManyThrough(Product::class, Category::class, 'id', 'category_id',
            'id', 'category_id');
    }
}
