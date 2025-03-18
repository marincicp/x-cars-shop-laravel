<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UpdateCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            "maker_id" => ["required", "integer", "min:1", "exists:makers,id"],
            "model_id" => ["required", "integer", "min:1", "exists:models,id"],
            "year" => ["required", "integer", "min:1990", "max:" . date("Y")],
            "car_type_id" => ["required", "integer", "min:1", "exists:car_types,id"],
            "city_id" => ["required", "integer", "min:1", "exists:cities,id"],
            // "vin" => ["required", "size:2"],
            "vin" => ["nullable"],
            "mileage" => ["required", "integer", "min:0"],
            "price" => ["required", "integer", "min:0"],
            "fuel_type_id" => ["required", "integer", "min:1", "exists:fuel_types,id"],
            "address" => ["required", "string"],
            "description" => ["required", "max:500"],
            "phone" => ["required", "regex:/^\+?\d{7,15}$/"],

            "car_features" => ["nullable", "array"],
            "car_features.*" =>  [
                function ($attribute, $value, $fail) {
                    $column = Str::afterLast($attribute, '.');
                    if (! Schema::hasColumn("car_features", $column)) {
                        $fail("The $column does not exist");
                    }
                }
            ],
        ];
    }
}
