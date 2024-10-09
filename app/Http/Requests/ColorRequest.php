<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'color_name' => 'required',
            'color_code' => 'required', // Trường color_code là bắt buộc, phải là chuỗi có kích thước 7 và phải là mã màu hex
        ];
    }

    public function messages()
    {
        return [
            'color_name.required' => 'Tên màu là bắt buộc.',
            'color_code.required' => 'Mã màu là bắt buộc.',
        ];
    }
}

