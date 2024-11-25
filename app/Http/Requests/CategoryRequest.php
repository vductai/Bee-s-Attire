<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_name' => ['required','min:2','max:50','regex:/^[\pL\s]+$/u'],
            'id' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'category_name.max' => 'Tên danh mục không được quá 255 kí tự.!',
            'id.required' => 'Chọn danh mục gốc',
            'category_name.required' => 'Vui lòng nhập',
            'category_name.min' => 'Nhập tối thiểu :min kí tự',
            'category_name.max' => 'Chỉ nhập tối đa :min kí tự',
            'category_name.regex' => 'Không được chứa kí tự và số',
        ];
    }
}
