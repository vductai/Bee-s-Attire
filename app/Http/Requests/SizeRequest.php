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
            'size' => 'required|string|regex:/^(XS|S|M|L|XL|XXL)$/',
        ];
    }


    public function messages(): array
    {
        return [
            'size.required' => 'Vui lòng chọn size quần áo.',
            'size.string' => 'Tên Size phải là một chuỗi.',
            'size.regex' => 'Size không hợp lệ. Vui lòng chọn các size sau XS, S, M, L, XL, XXL.',
        ];
    }
}
