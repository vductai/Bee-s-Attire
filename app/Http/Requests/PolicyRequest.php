<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PolicyRequest extends FormRequest
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
            'title' => 'required', 
            'content_post' => 'required', 
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'content_post.required' => 'Nội dung là bắt buộc.',
        ];
    }
}
