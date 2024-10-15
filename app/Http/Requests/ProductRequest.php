<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_name',
            'product_avatar',
            'product_price',
            'product_desc',
            'sale_price',
            'category_id',
            'product_images',
            'product_images.*',
            'slug',
            'color_id',
            'color_id.*',
            'size_id',
            'size_id.*',
            'quantity',
            'action'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
