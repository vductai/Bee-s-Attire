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
            'max_discount' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'voucher_desc.required' => 'Mô tả voucher bắt buộc điền',
            'voucher_code.required' => 'Mã code voucher bắt buộc điền',
            'voucher_price.required' => 'Giá voucher bắt buộc điền',
            'voucher_price.numeric' => 'Giá voucher bắt buộc là số',
            'max_discount.required' => 'Giá giảm tối đa voucher bắt buộc điền',
            'max_discount.numeric' => 'Giá giảm tối đa voucher bắt buộc là số',
        ];
    }
}
