<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'product_id'=> 'required',
            'color_id'=> 'required',
            'size_id'=> 'required',
            'quantity' => 'required'
        ];
    }


    public function messages(): array
    {
        return [
            'product_id.required' => 'Vui lòng chọn',
            'color_id' => 'Vui lòng chọn',
            'size_id' => 'Vui lòng chọn',
            'quantity' => 'Vui lòng nhập số lượng',
        ];
    }


}
