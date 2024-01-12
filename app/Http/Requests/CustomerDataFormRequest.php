<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerDataFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',  // Assuming a `users` table
            'phone' => 'required|string',
            'address' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'phone.required' => 'Please enter your phone number.',
            'address.required' => 'Please enter your address.',
        ];
    }
}
