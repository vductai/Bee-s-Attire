<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class forgotPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
