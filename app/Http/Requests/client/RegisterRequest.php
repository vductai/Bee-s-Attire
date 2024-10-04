<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required', 'confirmed'],
            'email' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
