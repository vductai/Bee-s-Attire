<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:255',
            'product_avatar' => 'image|mimes:jpg,jpeg,png,gif',
            'product_price' => 'required|decimal|max:255',
            'product_desc' => 'string',
            'sale_price' => 'required|decimal|max:255',
            'category_id' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'product_name.required' => 'Vui lòng điền tên sản phẩm!',
            'product_name.max' => 'Tên sản phẩm không được quá 255 kí tự!',
            'product_avatar.image' => 'Hình ảnh không hợp lệ.',
            'product_avatar.mimes' => 'Hình ảnh không hợp lệ.',
            'product_price.required' => 'Vui lòng điền giá sản phẩm',
            'product_price.decimal' => 'Giá sản phẩm phải là số',
            'product_price.max' => 'Giá sản phẩm không được quá 255 kí tự',
            'sale_price.required' => 'Vui lòng điền giá sale của sản phẩm',
            'sale_price.max' => 'Không được quá 255 kí tự',
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm',
        ];
    }
}
