<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'avatar',
            'username',
            'password',
            'email',
            'gender',
            'phone',
            'birthday',
            'address',
            'role_id',
            'voucher_id'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }




}