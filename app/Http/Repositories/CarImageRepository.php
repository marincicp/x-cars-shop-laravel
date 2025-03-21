<?php

namespace App\Http\Repositories;

use App\Models\Car;

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
}
