<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => 'required|string', 
            'subtitle' => 'required|string', 
            'description' => 'required|string', 
            'image' => 'required|mimes:jpeg,png|dimensions:width=1920,height=900', 
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'subtitle.required' => 'Vui lòng nhập phụ đề.',
            'image.required' => 'Ảnh là bắt buộc.',
            'image.mimes' => 'Ảnh phải có định dạng jpeg hoặc png.',
            'image.dimensions' => 'Ảnh phải có kích thước 1920x900.',
        ];
    }
}
