<?php

use App\Http\Controllers\Api\CarImageApiController;
use App\Http\Controllers\Api\CityApiController;
use App\Http\Controllers\Api\ModelApiController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;


// Guest middleware
Route::middleware("guest")->group(function () {
   Route::get('/signup', [SignupController::class, "create"])->name("signup");
   Route::post('/signup', [SignupController::class, "store"])->name("register");

   Route::get('/login', [LoginController::class, "create"])->name("login");
   Route::post('/login', [LoginController::class, "store"])->name("store");

   // OAuth
   Route::get('/auth/redirect', [LoginController::class, "googleRedirect"])->name("google");
   Route::get('/auth/google/callback', [LoginController::class, "googleLogin"]);
});


// Auth middleware
Route::middleware("auth")->group(function () {

   Route::delete('/logout', [LoginController::class, "destroy"])->name("logout");

   // Cars
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


   // Car image
   Route::controller(CarImageController::class)->group(function () {
      Route::get("car/{car}/edit/images", "editImages")->name("car.images");
      Route::put("car/{car}/edit/images", "updateImages")->name("car.update-images");
   });
});





Route::get('/', [HomeController::class, "index"])->name("home");


// Cars
Route::get("/car/search", [CarController::class, "search"])->name("car.search");
Route::get("car/{car}", [CarController::class, "show"])->name("car.show");


/// API
Route::get("/makers/{maker_id}/models", [ModelApiController::class, "getModelsByMaker"]);
Route::get("/states/{state_id}/cities", [CityApiController::class, "getCitiesByState"]);

Route::delete("/car/{car}/images/{image_id}", action: [CarImageApiController::class, "destroy"])->name("carImage.delete");
