<?php

use App\Http\Controllers\Api\CityApiController;
use App\Http\Controllers\Api\ModelApiController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;





////////////////////////////
// LOGIN
Route::get('/signup', [SignupController::class, "create"])->name("signup")->middleware("guest");
Route::post('/signup', [SignupController::class, "store"])->name("register")->middleware("guest");

Route::get('/login', [LoginController::class, "create"])->name("login")->middleware("guest");
Route::post('/login', [LoginController::class, "store"])->name("store")->middleware("guest");
Route::delete('/logout', [LoginController::class, "destroy"])->name("logout")->middleware("auth");


// OAuth
Route::get('/auth/redirect', [LoginController::class, "googleRedirect"])->name("google");
Route::get('/auth/google/callback', [LoginController::class, "googleLogin"]);





Route::get('/', [HomeController::class, "index"])->name("home");




////////////////////////////
// CARS
Route::get("/car/search", [CarController::class, "search"])->name("car.search");
Route::get("/car/watchlist", [CarController::class, "watchlist"])->name("car.watchlist")->middleware("auth");

Route::resource("car", CarController::class);



////////////////////////////
/// API
Route::get("/makers/{maker_id}/models", [ModelApiController::class, "getModelsByMaker"]);
Route::get("/states/{state_id}/cities", [CityApiController::class, "getCitiesByState"]);
