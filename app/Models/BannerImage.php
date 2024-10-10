<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BannerImage extends Model
{
    use HasFactory;

    protected $table = 'banner_images'; 
    protected $primaryKey = 'banner_images_id';

    protected $fillable = [
        'banner_id',
        'image_path',
    ];

    public function banner(): BelongsTo
    {
        return $this->belongsTo(Banner::class, 'banner_id');
    }
}
