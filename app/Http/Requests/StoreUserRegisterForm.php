<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRegisterForm extends FormRequest
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
            "email" => ["email", "required", "unique:users,email"],
            "password" => ["required", "confirmed", Password::min(3)],
            "firstName" =>  ["required", "string"],
            "lastName" => ["required", "string"],
            'phone' => 'nullable|regex:/^[0-9]{10,15}$/',
        ];
    }
}
