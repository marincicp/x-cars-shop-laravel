<?php

namespace App\Http\Repositories;

use App\Models\Car;
use Exception;
use Illuminate\Support\Facades\DB;

class CarImageRepository
{

   /**
    * Delete car image
    * @return bool
    */
   public function deleteCarImage(Car $car, int $imageId): bool
   {
      $image = $car->images()->find($imageId);

      if (!$image) {
         return false;
      }

      return $image->delete();
   }



   /**
    * Change the order of car images
    * @return bool
    */
   public function updateCarImageOrder(Car $car, array $data)
   {
      try {
         $isUpdated = DB::transaction(function () use ($car, $data) {
            foreach ($data["images"] as $imageId => $imgPosition) {
               $updated = $car->images()->where("id", $imageId)->update(["position" => $imgPosition]);

               if ($updated === 0) {
                  throw new Exception("Failed to update image ID: $imageId");
               }
            }

            return true;
         });
      } catch (Exception $err) {
         $isUpdated = false;
      }

      return $isUpdated;
   }
}
