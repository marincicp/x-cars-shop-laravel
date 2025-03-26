<?php

use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth", "verified"])->group(function () {
   Route::get("/settings/change-password", [PasswordController::class, "edit"])->name("password.edit");
   Route::put("/settings/change-password", [PasswordController::class, "update"])->name("password.update");


   Route::get("settings/user/{user}/edit", [ProfileController::class, "edit"])->name("user.edit")->can("update", "user");
   Route::put("settings/user/{user}", [ProfileController::class, "update"])->name("user.update");
});
