<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'], // Kiểm tra email đúng định dạng
            'password' => [
                'required',
                'min:6', // Mật khẩu phải có ít nhất 6 ký tự
                'regex:/[A-Z]/', // Ít nhất một chữ hoa
                'regex:/[a-z]/', // Ít nhất một chữ thường
                'regex:/[0-9]/', // Ít nhất một chữ số
                'regex:/[@$!%*#?&]/', // Ít nhất một ký tự đặc biệt
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.regex' => 'Email không đúng định dạng.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.regex' => 'Mật khẩu phải bao gồm ít nhất một chữ hoa, một chữ thường, một chữ số và một ký tự đặc biệt.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
