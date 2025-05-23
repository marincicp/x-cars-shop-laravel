<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CarFeatureRequest extends FormRequest
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

    // TODO zavrsiti
    public function rules(): array
    {
        return [
            'car_features' => ['nullable', 'array'],

            'car_features.*' => [
                function ($attribute, $value, $fail) {
                    $column = Str::afterLast($attribute, '.');
                    if (! Schema::hasColumn('car_features', $column)) {
                        $fail("The $column does not exist");
                    }
                },
            ],
        ];
    }
}
