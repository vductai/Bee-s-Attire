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

    public function authorize()
    {
        return true;
    }
}
