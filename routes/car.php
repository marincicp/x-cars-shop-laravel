<?php

use App\Http\Controllers\Api\CarImageApiController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarImageController;
use Illuminate\Support\Facades\Route;



Route::middleware("auth")->group(function () {

   Route::controller(CarController::class)->group(function () {
      Route::get("car", "index")->name("car.index");
      Route::get("car/create", "create")->name("car.create");
      Route::post("car", "store")->name("car.store");
      Route::delete("car/{car}", "destroy")->name("car.destroy")->can("delete", "car");
      Route::post("car/{car}", "show")->name("car.show");
      Route::put("cars/{car}", "update")->name("car.update")->can("update", "car");
      Route::post("car/{car}", "addToWatchlist")->name("car.addToWatchlist");
      Route::get("car/watchlist", "watchlist")->name("car.watchlist");
      Route::delete("car/watchlist/{car}", "removeFromWatchlist")->name("car.removeFromWatchlist");
      Route::get("car/{car}/edit", "edit")->name("car.edit");
   });


   Route::controller(CarImageController::class)->group(function () {
      Route::get("car/{car}/edit/images", "editImages")->name("car.images");
      Route::put("car/{car}/edit/images", "updateImages")->name("car.update-images");
   });
});



Route::get("/car/search", [CarController::class, "search"])->name("car.search");
Route::get("car/{car}", [CarController::class, "show"])->name("car.show");




// API
Route::delete("/car/{car}/images/{image_id}", action: [CarImageApiController::class, "destroy"])->name("carImage.delete");
