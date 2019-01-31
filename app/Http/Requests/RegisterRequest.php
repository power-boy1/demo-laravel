<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'password' => ['required', 'string', 'min:5', 'max:64', 'confirmed'],
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'PASSWORDS DON\'T MATCH!',
            'password.required' => 'THE PASSWORD FIELD IS REQUIRED',
            'password_confirmation.required' => 'THE PASSWORD CONFIRMATION FIELD IS REQUIRED',
            'email.email' => 'PLEASE ENTER A VALID EMAIL ADDRESS',
            'email.required' => 'THE EMAIL FIELD IS REQUIRED',
            'email.max' => 'PLEASE ENTER EMAIL OF LESS THAN 50 CHARACTERS',
            'name.max' => 'PLEASE ENTER FIRST NAME OF LESS THAN 50 CHARACTERS',
            'name.required' => 'THE FIRST NAME FIELD IS REQUIRED',
        ];
    }
}
