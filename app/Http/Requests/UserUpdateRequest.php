<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => 'required',
            'username' => 'required|string|max:255',
            'email' => 'required|max:255',
            'gender' => 'required',
            'phone' => 'required|string|max:255',
            'birthday' => 'required|date',
            'address' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'avatar.required' => 'Hình ảnh không hợp lệ.',

            'username.required' => 'Vui lòng điền tên',
            'username.max' => 'Tên không vượt quá 255 kí tự',

            'email.required' => 'Vui lòng điền Email',
            'email.max' => 'Email không vượt quá 255 kí tự',

            'gender.required' => 'Vui lòng chọn giới tính',

            'phone.required' => 'Vui lòng điền số điện thoại',
            'phone.max' => 'Số điện thoại không vượt quá 255 kí tự',


            'birthday.required' => 'Vui lòng nhập ngày tháng năm',
            'birthday.date' => 'Không đúng định dạng',


            'address.required' => 'Vui lòng nhập địa chỉ',
            'address.max' => 'Địa chỉ không vượt quá 255 kí tự',

        ];
    }
}
