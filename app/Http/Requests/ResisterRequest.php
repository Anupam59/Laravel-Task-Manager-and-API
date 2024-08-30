<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResisterRequest extends FormRequest
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
            'name' => 'required|min:3|max:150',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:25',
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name',
            'name.min' => 'Name must be atleast 3 chars long',
            'name.max' => 'Name must not be more than 150 chars',
            'email.required' => 'Please enter your email',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email is already taken. Please try other email address',
            'password.required' => 'Please enter your password',
            'password.min' => 'Password must be atleast 5 chars long',
            'password.max' => 'Password must not be more than 25 chars',
            'password_confirmation.required' => 'Please enter your password confirmation',
            'password_confirmation.same' => 'Password confirmation must match password.',
        ];
    }
}
