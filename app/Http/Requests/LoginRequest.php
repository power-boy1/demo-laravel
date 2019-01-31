<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:5', 'max:64',
            ],
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'THE PASSWORD FIELD IS REQUIRED',
            'email.email' => 'PLEASE ENTER A VALID EMAIL ADDRESS',
            'email.required' => 'THE EMAIL FIELD IS REQUIRED',
        ];
    }
}
