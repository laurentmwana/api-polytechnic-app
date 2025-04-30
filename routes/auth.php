<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('register', RegisteredUserController::class);

    Route::post('login', [AuthenticatedSessionController::class, 'login'])
        ->name('login');

    Route::post('forgot-password', PasswordResetLinkController::class)
        ->name('password.email');

    Route::post('reset-password', NewPasswordController::class)
        ->name('password.store');
});

Route::middleware('auth')->group(function () {

    Route::post('email/verification-notification', EmailVerificationNotificationController::class)
        ->middleware('throttle:50,1')
        ->name('verification.send');

    Route::post('email/verify/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:50,1'])
        ->name('verification.verify');

    Route::post('confirm-password', ConfirmablePasswordController::class);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
