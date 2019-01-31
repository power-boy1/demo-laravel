<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'password' => ['required', 'string', 'min:5', 'max:64', 'confirmed'],
            'password_confirmation' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'PASSWORDS DON\'T MATCH!',
            'password.required' => 'THE PASSWORD FIELD IS REQUIRED',
            'password_confirmation.required' => 'THE PASSWORD CONFIRMATION FIELD IS REQUIRED'
        ];
    }
}
