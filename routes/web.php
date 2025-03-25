<?php

use App\Http\Controllers\Api\CityApiController;
use App\Http\Controllers\Api\ModelApiController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, "index"])->name("home");


/// API
Route::get("/makers/{maker_id}/models", [ModelApiController::class, "getModelsByMaker"]);
Route::get("/states/{state_id}/cities", [CityApiController::class, "getCitiesByState"]);


require __DIR__ . "/auth.php";
require __DIR__ . "/settings.php";
require __DIR__ . "/car.php";
