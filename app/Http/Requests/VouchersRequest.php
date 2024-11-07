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
    public function rules(): array
    {
        return [
            'voucher_code' => 'required|string|max:255',
            'voucher_price' => 'required|numeric',
            'voucher_desc' => 'required|string|max:255',
            'start_date' => 'required|date|max:255',
            'end_date' => 'required|date|max:255',
            'quantity' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'voucher_desc.required' => 'Mô tả voucher bắt buộc điền',
            'quantity.required' => 'Nhập số lượng',
            'voucher_code.required' => 'Mã code voucher bắt buộc điền',
            'voucher_price.required' => 'Giá voucher bắt buộc điền',
            'start_date.required' => 'Nhập ngày bắt đầu',
            'end_date.required' => 'Nhập ngày hết hạn',
        ];
    }
}
