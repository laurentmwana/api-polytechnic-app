<?php

use App\Helpers\SpatieNameMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentCourseFollowController;
use App\Http\Controllers\Student\StudentPaidLaboratoryController;

Route::prefix('/student')
    ->middleware(['auth', SpatieNameMiddleware::student()])
    ->name('##')->group(function () {
        Route::get('/course-followed/{id}', [StudentCourseFollowController::class, 'show'])
            ->name('followed.show');

        Route::get('/course-followed', [StudentCourseFollowController::class, 'index'])
            ->name('followed.index');

        Route::get('/paid-laboratory/{id}', [StudentPaidLaboratoryController::class, 'show'])
            ->name('paid-labo.show');

        Route::get('/paid-laboratory', [StudentPaidLaboratoryController::class, 'index'])
            ->name('paid-labo.index');
    });
