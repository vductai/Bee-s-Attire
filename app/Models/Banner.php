<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners'; 
    protected $primaryKey = 'banner_id';
    protected $fillable = ['banner_title', 'banner_subtitle', 'banner_description', 'banner_image'];

    public function imageBanners(): HasMany
    {
        return $this->hasMany(BannerImage::class, 'banner_id');
    }
}
