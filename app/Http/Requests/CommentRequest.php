<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'product_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User id là bắt buộc!',
            'product_id.required' => 'Product id là bắt buộc!',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
