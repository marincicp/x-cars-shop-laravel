<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

use App\Constants\CarFeatures;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            "car_features" => ["nullable", "array"],

            "car_features.*" =>  [
                function ($attribute, $value, $fail) {
                    $column = Str::afterLast($attribute, '.');
                    dump($column, $value);
                    if (! Schema::hasColumn("car_features", $column)) {
                        $fail("The $column does not exist");
                    }
                }
            ]
        ];
    }
}