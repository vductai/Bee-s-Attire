<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'size_name' => 'required|string|regex:/^(XS|S|M|L|XL|XXL)$/',
        ];
    }


    public function messages(): array
    {
        return [
            'size_name.required' => 'Vui lòng chọn size quần áo.',
            'size_name.string' => 'Tên Size phải là một chuỗi.',
            'size_name.regex' => 'Size không hợp lệ. Vui lòng chọn các size sau XS, S, M, L, XL, XXL.',
        ];
    }
}
