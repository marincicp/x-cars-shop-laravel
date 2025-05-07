<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('user-update', $this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['email', Rule::requiredIf(! $this->user()->google_id), Rule::unique('users', 'email')->ignore($this->user()->id)],
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'phone' => ['nullable', 'regex:/^[0-9]{10,15}$/'],

        ];
    }
}
