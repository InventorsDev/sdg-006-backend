<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->check();;
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
            'email' => 'required|string|email|max:255|unique:users,email,'.auth('api')->user()->id,
            'phone_number' => 'required|numeric',
            'dob'=> 'required',
            'address' => 'required',
            'means_of_id' => 'required',
            'id_key' => 'required',
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
            'phone_number.required' => 'phone number field cannot be empty',
            'phone_number.numeric' => 'Enter a valid phone number',
            'phone_number.max' => 'Enter a valid phone number',
            'phone_number.min' => 'Enter a valid phone number',
            'dob.required' => 'Date of birth field cannot be empty',
            'address.required' => 'Address field cannot be empty',
            'means_of_id.required' => 'Select a valid means of identification used in your country',
            'id_key.required' => 'identication number or key cannot be empty',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            // 'password' => (string) $this->unique_no ? $this->unique_no : "unknown",
        ]);
    }
}
