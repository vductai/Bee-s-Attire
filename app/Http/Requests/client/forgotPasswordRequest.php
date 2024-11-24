<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class forgotPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/', // Ít nhất một chữ hoa
                'regex:/[a-z]/', // Ít nhất một chữ thường
                'regex:/[0-9]/', // Ít nhất một chữ số
                'regex:/[@$!%*#?&]/', // Ít nhất một ký tự đặc biệt
            ],
            'token' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.regex' => 'Email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password.min' => 'Mật khẩu phải chứa ít nhất :min ký tự.',
            'password.regex' => 'Mật khẩu phải bao gồm ít nhất một chữ hoa, một chữ thường, một chữ số và một ký tự đặc biệt.',
            'token.required' => 'Token không hợp lệ.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
