<?php

use App\Helpers\SpatieNameMiddleware;
use App\Http\Controllers\Student\StudentCourseFollowController;
use Illuminate\Support\Facades\Route;

Route::prefix('/student')
    ->middleware(['auth', SpatieNameMiddleware::student()])
    ->name('##')->group(function () {
        Route::get('/course-followed/{id}', [StudentCourseFollowController::class, 'show'])
            ->name('followed.show');

        Route::delete('/course-followed/{id}/destroy', [StudentCourseFollowController::class, 'destroy'])->name('followed.destroy');

        Route::get('/course-followed', [StudentCourseFollowController::class, 'index'])
            ->name('followed.index');
    });
