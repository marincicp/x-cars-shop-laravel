<?php

use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('/signup', [SignupController::class, 'create'])->name('signup');
    Route::post('/signup', [SignupController::class, 'store'])->name('register');

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('store');

    // OAuth
    Route::get('/auth/redirect', [LoginController::class, 'redirectToGoogle'])->name('google');
    Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
});

Route::middleware('auth')->group(function () {

    // Route::get("user/{user}/edit", [ProfileController::class, "edit"])->name("user.edit")->can("update", "user");
    // Route::put("user/{user}", [ProfileController::class, "update"])->name("user.update");

    Route::get('/email/verify', EmailVerificationPromptController::class)->name('verification.notice');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)->middleware('signed')->name('verification.verify');

    Route::delete('/logout', [LoginController::class, 'destroy'])->name('logout');
});
