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
            'voucher_price' => 'required|string|max:255',
            'voucher_desc' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'voucher_desc.required' => 'Mô tả voucher bắt buộc điền',
            'voucher_code.required' => 'Mã code voucher bắt buộc điền',
            'voucher_price.required' => 'Giá voucher bắt buộc điền',
            'start_date.required' => 'Vui lòng điền ngày bắt đầu voucher!',
            'end_date.required' => 'Vui lòng điền ngày kết thúc voucher!',
            'voucher_code.max' => 'Code voucher không được quá 255 kí tự',
            'voucher_price.max' => 'Giá voucher không được quá 255 kí tự',
        ];
    }
}
