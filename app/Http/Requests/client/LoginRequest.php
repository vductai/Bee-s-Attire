<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required'],
            'email' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
