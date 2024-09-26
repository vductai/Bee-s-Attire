<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id',
            'color_id',
            'size_id'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
