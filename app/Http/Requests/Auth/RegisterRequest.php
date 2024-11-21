<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email','unique:users,email'],
            'address' => ['required', 'max:255'],
            'phone' => ['required', 'regex:/^[0-9]{10}$/'],
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'confirm_password.same' => 'The confirmation password does not match.',
            'email.same' => 'Email already exists.',
            'password.min' =>'Password must be more than 6 characters',
            'phone.regex' => 'Phone number is incorrect',
        ];
    }
}
