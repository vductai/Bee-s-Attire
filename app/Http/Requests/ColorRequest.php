<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'color_name' => 'required|string|max:255',
            'color_code' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'color_name' => 'Tên màu sắc bắt buộc phải điền!',
            'color_code' => 'Code màu sắc bắt buộc phải điền!'
        ];
    }


    
}
