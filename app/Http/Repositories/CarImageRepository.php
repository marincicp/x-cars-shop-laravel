<?php

namespace App\Http\Repositories;

use App\Models\Car;
use Illuminate\Support\Facades\DB;

class CarImageRepository
{
    /**
     * Delete car image
     */
    public function deleteCarImage(Car $car, int $imageId): bool
    {
        $image = $car->images()->find($imageId);

        if (! $image) {
            return false;
        }

        return $image->delete();
    }

    /**
     * Change the order of car images
     *
     * @return bool
     */
    public function updateCarImageOrder(Car $car, array $data)
    {
        return
           DB::transaction(function () use ($car, $data) {
               foreach ($data['images'] as $imageId => $imgPosition) {

                   $car->images()->where('id', $imageId)->update(['position' => $imgPosition]);
               }
           });
    }
}
