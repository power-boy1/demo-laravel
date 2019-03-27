<?php

namespace App\Http\Requests\Management\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'min:1'],
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'role' => ['required', 'integer', 'min:1'],
            'password' => ['nullable', 'string', 'min:5', 'max:64']
        ];
    }

    public function messages()
    {
        return [
            'role.required' => 'THE ROLE FIELD IS REQUIRED',
            'email.email' => 'PLEASE ENTER A VALID EMAIL ADDRESS',
            'email.required' => 'THE EMAIL FIELD IS REQUIRED',
            'email.max' => 'PLEASE ENTER EMAIL OF LESS THAN 50 CHARACTERS',
            'name.max' => 'PLEASE ENTER FIRST NAME OF LESS THAN 50 CHARACTERS',
            'name.required' => 'THE FIRST NAME FIELD IS REQUIRED',
        ];
    }
}
