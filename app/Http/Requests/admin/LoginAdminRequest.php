<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginAdminRequest extends FormRequest
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
