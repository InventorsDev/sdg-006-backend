<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone_number' => 'required|numeric',
            'password' => 'required|min:6',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.required' => 'firstname field is required!',
            'lastname.required' => 'lastname field is required!',
            'email.unique' => 'Email has been taken by another user',
            'phone_number.required' => 'phone number field cannot be empty',
            'phone_number.numeric' => 'Enter a valid phone number',
            'phone_number.max' => 'Enter a valid phone number',
            'phone_number.min' => 'Enter a valid phone number',
            'password.required' => 'Password field cannot be empty',
            'password.min' => 'password should be more than six character',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            // 'password' => (string) $this->unique_no ? $this->unique_no : "unknown",
        ]);
    }
}
