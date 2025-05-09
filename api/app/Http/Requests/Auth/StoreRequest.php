<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ];
    }

    /**
     * Returns the custom validation error messages for the Trainer StoreRequest.
     *
     * @return array An associative array where the keys represent validation rules
     *               and the values are the corresponding error messages.
     *
     * Messages:
     * - 'name.required': Triggered when the name field is missing.
     * - 'email.required': Triggered when the email field is missing.
     * - 'email.email': Triggered when the email field does not contain a valid email address.
     * - 'email.unique': Triggered when the email address is already in use.
     * - 'password.required': Triggered when the password field is missing.
     * - 'password.min': Triggered when the password is less than 8 characters long.
     * - 'password.confirmed': Triggered when the password confirmation does not match the password.
     * - 'password_confirmation.required': Triggered when the password confirmation field is missing.
     * - 'password_confirmation.min': Triggered when the password confirmation is less than 8 characters long.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password_confirmation.required' => 'The password confirmation field is required.',
            'password_confirmation.min' => 'The password confirmation must be at least 8 characters long.',
            'password_confirmation.same' => 'The password confirmation must match the password.',
        ];
    }
}
