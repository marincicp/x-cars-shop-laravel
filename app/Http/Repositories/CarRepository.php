<?php


namespace App\Http\Repositories;

use App\Filters\QueryFilter;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarRepository
{

   public  function createCar($data)
   {
      return DB::transaction(function () use ($data) {

         $car = Auth::user()->cars()->create($data);

         foreach ($data["images"] as $index => $img) {
            $imgPath = $img->store("carImages");
            $car->images()->create([
               "image_path" => $imgPath,
               "position" => $index + 1
            ]);
         }

         if (!empty($data["car_features"])) {
            $car->features()->create($data["car_features"]);
         }

         return $car;
      });
   }




   public function updateCar(Car $car, $data)
   {
      return DB::transaction(function () use ($car, $data) {

         $car->update($data);

         $car->features()->delete();
         if (!empty($data["car_features"])) {
            $car->features()->create($data["car_features"]);
         }

         return $car;
      });
   }



   /**
    * Get a list of cars that the current user has added
    */
   public function  getCurrentUserAddedCars()
   {
      return Auth::user()->cars()->with(["primaryImage", "model", "maker"])->orderBy("created_at", "desc")->paginate(15);
   }



   /**
    * Get a list of cars that the current user marked as favorite
    */
   public function getCurrentUserFavoriteCars()
   {
      return Auth::user()->favoriteCars()->with(["carType", "fuelType", "maker", "model",  "city", "primaryImage"])->paginate(15);
   }



   /**
    * Get a list of cars filtered by query parameters.
    */

   public function getCarsByQueryParams(Request $request)
   {

      $query = Car::select("cars.*")->with("model", "maker", "carType", "primaryImage", "city", "fuelType")->where("published_at", "<", now());

      return QueryFilter::apply($query, $request)->paginate(15);
   }


   public function deleteCar(Car $car)
   {

      return DB::transaction(function () use ($car) {
         $car->features()->delete();
         $res =  $car->deleteOrFail();
      });
   }



   public function isFavoriteCar(Car $car)
   {
      if (Auth::check()) {
         return $car->favoritedCars()->where("user_id", Auth::user()->id)->exists();
      }

      return false;
   }

   public function addToWatchilst(Car $car)
   {
      if ($this->isFavoriteCar($car)) {
         return false;
      }

      $car->favoritedCars()->attach(["user_id" => Auth::user()->id]);

      return true;
   }

   public function removeFromWatchlist(Car $car)
   {

      if (! $this->isFavoriteCar($car)) {
         return false;
      }
      $car->favoritedCars()->detach(Auth::user()->id);

      return true;
   }
}
