<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:5|max:25',
        ];
    }


    public function messages(): array
    {
        return [
            'email.required' => 'Please enter your email',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Please enter your password',
            'password.min' => 'Password must be atleast 5 chars long',
            'password.max' => 'Password must not be more than 25 chars',
        ];
    }
}
