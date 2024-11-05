<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'color_name' => 'required|string|max:255',
            'color_code' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'color_name.required' => 'Không được bỏ trống!',
            'color_name.max' => 'Tên màu sắc không quá 255 kí tự!',

            'color_code.required' => 'Chọn màu sắc!'
        ];
    }
}
