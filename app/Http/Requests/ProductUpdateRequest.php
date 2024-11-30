<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:255',
            'product_avatar',
            'product_price' => 'required|numeric|min:0',
            'product_desc' => 'required',
            'sale_price' => 'nullable|numeric|min:0',
            'category_id' => 'required',
            'product_images',
            'product_images.*',
        ];
    }

    public function messages(): array
    {
        return [
            // product_name
            'product_name.required' => 'Tên sản phẩm là bắt buộc.',
            'product_name.string' => 'Tên sản phẩm phải là chuỗi ký tự.',
            'product_name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            // product_price
            'product_price.required' => 'Giá sản phẩm là bắt buộc.',
            'product_price.numeric' => 'Giá sản phẩm phải là một số.',
            'product_price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',
            // product_desc
            'product_desc.required' => 'Mô tả sản phẩm là bắt buộc.',
            // sale_price
            'sale_price.numeric' => 'Giá khuyến mãi phải là một số.',
            'sale_price.min' => 'Giá khuyến mãi phải lớn hơn hoặc bằng 0.',
            // category_id
            'category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
