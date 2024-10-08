<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'color_name',
            'color_code'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
