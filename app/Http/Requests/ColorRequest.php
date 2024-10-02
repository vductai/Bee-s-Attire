<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;


class ColorRequest extends FormRequest
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
            'name_color' => 'required|string|max:50',  // Bắt buộc, chuỗi ký tự, tối đa 50 ký tự
            'code_color' => [
                'required',
                'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'  // Bắt buộc, định dạng mã màu hợp lệ (#RRGGBB hoặc #RGB)
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json(
            [
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $errors->messages(),
            ],
            Response::HTTP_BAD_REQUEST
        );

        throw new HttpResponseException($response);
    }
}
