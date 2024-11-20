<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => ['required', 'max:5'],
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'confirm_password.same' => 'The confirmation password does not match.',
            'password.min' =>'Password must be more than 6 characters',
            'code.max' => 'Your code must be 5 digits long.'
        ];
    }
}
