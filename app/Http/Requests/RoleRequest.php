<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'role_name' => ['required', 'min:1'],
            'role_desc' => ['required', 'min:1']
        ];
    }

    public function messages()
    {
        return [
            'role_name.required' => 'Vui lòng không để trống',
            'role_name.min' => 'Vui lòng điền từ 2 kí tự trở lên',

            'role_desc.required' => 'Vui lòng không để trống',
            'role_desc.min' => 'Vui lòng điền từ 2 kí tự trở lên',

        ];
    }

    public function authorize()
    {
        return true;
    }
}
