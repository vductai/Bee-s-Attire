<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id',
            'product_id',
            'comment'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
