<?php


namespace App\Http\Repositories;

use App\Filters\QueryFilter;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}