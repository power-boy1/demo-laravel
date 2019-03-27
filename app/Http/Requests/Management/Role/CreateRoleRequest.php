<?php

namespace App\Http\Requests\Management\Role;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'description' => ['max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'PLEASE ENTER NAME OF LESS THAN 50 CHARACTERS',
            'name.required' => 'THE NAME FIELD IS REQUIRED',
            'name.description' => 'PLEASE ENTER description OF LESS THAN 255 CHARACTERS',
        ];
    }
}
