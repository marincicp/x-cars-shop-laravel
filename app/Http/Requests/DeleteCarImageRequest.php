<?php

namespace App\Http\Requests;

use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

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
            "car_id" => ["required", "min:1"],
            "image_id" => ["required", "min:1"]
        ];
    }
}
