<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VouchersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(response()->json([
            'message' => 'Lỗi thêm vouchers!',
            'status' => false,
            'errors' => $validator->errors()
        ], 400));
    }
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'voucher_code' => 'required|string|max:255',
            'voucher_price' => 'required|string|max:255',
            'voucher_desc' => 'required|string',
            'start_date' => 'required|date|max:255',
            'end_date' => 'required|date|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'voucher_desc.required' => 'Mô tả voucher bắt buộc điền',
            'voucher_code.required' => 'Mã code voucher bắt buộc điền',
            'voucher_price.required' => 'Giá voucher bắt buộc điền',
            'start_date.required' => 'Điền star vochers',
            'end_date.required' => 'Điền end vochers',
        ];
    }
}
