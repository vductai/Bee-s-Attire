<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariantUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id'=> 'required',
            'color_id1'=> 'required',
            'size_id1'=> 'required',
            'quantity1' => 'required'
        ];
    }


    public function messages(): array
    {
        return [
            'product_id.required' => 'Vui lòng chọn',
            'color_id1' => 'Vui lòng chọn',
            'size_id1' => 'Vui lòng chọn',
            'quantity1' => 'Vui lòng nhập số lượng',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
