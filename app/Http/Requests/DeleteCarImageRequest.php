<?php

namespace App\Http\Requests;

use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

use function Pest\Laravel\get;

class DeleteCarImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $car =   Car::find($this->request->get("car_id"));

        if (!$car) {
            return false;
        }

        $imageExists = $car->images()->where("id", $this->request->get("image_id"))->exists();


        return $imageExists && Gate::allows("car-update", $car);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "car_id" => ["required", "min:1", "string"],
            "image_id" => ["required", "min:1", "string"]
        ];
    }


    public function after()
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->any()) {
                    return;
                }

                $car = Car::find($this->request->get("car_id"));

                if ($car->images()->count() === 1) {
                    throw ValidationException::withMessages([
                        'car_id' => 'Car must have minimum one image.',
                    ]);
                }
            }
        ];
    }
}
