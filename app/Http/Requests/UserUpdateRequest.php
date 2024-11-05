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
            'email' => 'required|email',
            'gender' => 'required',
            'phone' => 'required|numeric',
            'birthday' => 'required|date',
            'address' => 'required|string|max:255',
            'avatar'
        ];
    }

    public function messages(): array
    {
        return [
            'avatar.required' => 'Hình ảnh không hợp lệ.',

            'username.required' => 'Vui lòng điền tên',
            'username.max' => 'Tên không vượt quá 255 kí tự',

            'email.required' => 'Vui lòng điền Email.',
            'email.email' => 'Email phải đúng định dạng.',

            'gender.required' => 'Vui lòng chọn giới tính.',

            'phone.required' => 'Vui lòng điền số điện thoại.',
            'phone.numeric' => 'Số điện thoại phải là số.',

            'birthday.required' => 'Vui lòng nhập ngày tháng năm sinh.',
            'birthday.date' => 'Ngày sinh phải là định dạng ngày tháng hợp lệ.',

            'address.required' => 'Vui lòng nhập địa chỉ.',
            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'avatar.image' => 'Avatar phải là file ảnh.',
            'avatar.mimes' => 'Avatar phải có định dạng: jpeg, png, jpg, gif, svg.',
            'avatar.max' => 'Avatar không được vượt quá 2MB.'
        ];
    }
}
