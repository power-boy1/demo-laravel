<?php

namespace App\Http\Requests\Management\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:users'],
            'role' => ['required', 'integer', 'min:1'],
            'password' => ['required', 'string', 'min:5', 'max:64']
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'THE PASSWORD FIELD IS REQUIRED',
            'role.required' => 'THE ROLE FIELD IS REQUIRED',
            'email.email' => 'PLEASE ENTER A VALID EMAIL ADDRESS',
            'email.required' => 'THE EMAIL FIELD IS REQUIRED',
            'email.max' => 'PLEASE ENTER EMAIL OF LESS THAN 50 CHARACTERS',
            'name.max' => 'PLEASE ENTER FIRST NAME OF LESS THAN 50 CHARACTERS',
            'name.required' => 'THE FIRST NAME FIELD IS REQUIRED',
        ];
    }
}
