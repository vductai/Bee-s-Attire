<?php

namespace App\Http\Requests ;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
{
    /**
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'size_name' => 'required|string|max:225',
        ];
    }

    /**
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'size_name.required' => 'Tên kích thước là bắt buộc.',
            'size_name.string' => 'Tên kích thước phải là một chuỗi.',
            'size_name.max' => 'Tên kích thước không được vượt quá 225 ký tự.',
        ];
    }
}
