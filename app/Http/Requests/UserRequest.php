<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'avatar' => 'image',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'email' => 'required|email',
            'gender' => 'required',
            'phone' => 'required|numeric',
            'birthday' => 'required|date',
            'address' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Vui lòng điền tên',
            'username.max' => 'Tên không vượt quá 255 kí tự',

            'password.required' => 'Vui lòng điền Password',
            'password.max' => 'Password không vượt quá 255 kí tự',

            'email.required' => 'Vui lòng điền Email',
            'email.max' => 'Email không vượt quá 255 kí tự',

            'gender.required' => 'Vui lòng chọn giới tính',

            'phone.required' => 'Vui lòng điền số điện thoại',


            'birthday.required' => 'Vui lòng nhập ngày tháng năm',
            'birthday.date' => 'Không đúng định dạng',


            'address.required' => 'Vui lòng nhập địa chỉ',
            'address.max' => 'Địa chỉ không vượt quá 255 kí tự',

        ];
    }
}
