<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:255',
            'product_avatar' => 'required|mimes:jpg,png,jpeg,gif|max:2048',
            'product_price' => 'required|numeric|min:0',
            'product_desc',
            'sale_price' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'product_images',
            'product_images.*',
            'color_id',
            'color_id.*',
            'size_id' ,
            'size_id.*',
            'quantity',
        ];
    }

    public function messages(): array
    {
        return [
            'product_name.required' => 'Tên sản phẩm không được để trống.',
            'product_name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'product_avatar.required' => 'Hình ảnh đại diện là bắt buộc.',
            'product_avatar.mimes' => 'Hình ảnh đại diện chỉ được có định dạng: jpg, png, jpeg, gif.',
            'product_avatar.max' => 'Hình ảnh đại diện không được vượt quá 2MB.',
            'product_price.required' => 'Giá sản phẩm là bắt buộc.',
            'product_price.numeric' => 'Giá sản phẩm phải là số.',
            'product_price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',
            'sale_price.numeric' => 'Giá khuyến mãi phải là số.',
            'category_id.required' => 'Danh mục là bắt buộc.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }


}