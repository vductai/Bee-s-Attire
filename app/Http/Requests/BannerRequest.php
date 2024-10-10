<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'banner_title' => 'required|string|max:255',
            'banner_subtitle' => 'required|string|max:255',
            'banner_description' => 'required|string',
            'banner_image' => 'required|mimes:jpg,png',
            'image_banners.*' => 'required|mimes:jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'banner_title.required' => 'Vui lòng điền tiêu đề.',
            'banner_title.string' => 'Tiêu đề phải là một chuỗi.',
            'banner_title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            
            'banner_subtitle.required' => 'Vui lòng điền phụ đề.',
            'banner_subtitle.string' => 'Phụ đề phải là một chuỗi.',
            'banner_subtitle.max' => 'Phụ đề không được vượt quá 255 ký tự.',
            
            'banner_description.required' => 'Vui lòng điền mô tả.',
            'banner_description.string' => 'Mô tả phải là một chuỗi.',
            
            'banner_image.required' => 'Vui lòng chọn banner.',
            'banner_image.mimes' => 'Banner phải có định dạng: jpg,png.',
            
            'image_banners.*.required' => 'Vui lòng chọn banner.',
            'image_banners.*.mimes' => 'Banner phải có định dạng: jpg,png.',
        ];
    }
}
