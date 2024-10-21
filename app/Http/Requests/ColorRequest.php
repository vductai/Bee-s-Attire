<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
{
/**
     * Determine if the user is authorized to make this request.
     */

    public function rules(): array
    {
        return [
            'color_name' => 'required|string|max:255',
            'color_code' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'color_name' => 'required|string|max:255',
            'color_code' => 'required'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages()
    {
        return [
            'color_name.required' => 'Tên màu sắc bắt buộc phải điền!',
            'color_name.max' => 'Tên màu sắc không quá 255 kí tự!',

            'color_code.required' => 'Code màu sắc bắt buộc phải điền!'
        ];

    public function messages()
    {
        return [
            'color_name.required' => 'Không được bỏ trống!',
            'color_name.max' => 'Tên màu sắc không quá 255 kí tự!',

            'color_code.required' => 'Chọn màu sắc!'
        ];
    }
}
