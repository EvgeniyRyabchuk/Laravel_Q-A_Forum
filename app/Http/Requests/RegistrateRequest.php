<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegistrateRequest extends FormRequest
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

    public function messages()
    {
        return[
            'name.required' => 'The /// ame field is required.',
            'email' => [
                'required' => 'Please Enter Your Name 123',
                'min.20' => 'more chapters please'
            ], 
            'password.min' => 'moreeeeeeeeeeeeee'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'], 
            'email' => ['required', 'unique:users'], 
            'password' => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => ['required'], 
        ];
    }
}
