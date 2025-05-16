<?php

use App\Helpers\SpatieNameMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminProfessorController;
use App\Http\Controllers\Admin\AdminYearAcademicController;

Route::prefix('admin')
    ->middleware(['auth', SpatieNameMiddleware::admin()])
    ->name('#~')->group(function () {

        Route::get('/year-academic/{id}', [AdminYearAcademicController::class, 'show'])
            ->name('year-academic.show');

        Route::get('/year-academic/{id}/update', [AdminYearAcademicController::class, 'update'])
            ->name('year-academic.update');

        Route::get('/year-academic', [AdminYearAcademicController::class, 'index'])
            ->name('year-academic.index');

        Route::apiResource('student', AdminStudentController::class)
            ->parameter('student', 'id');

        Route::apiResource('professor', AdminProfessorController::class)
            ->parameter('professor', 'id');

        Route::apiResource('course', AdminCourseController::class)
            ->parameter('course', 'id');
    });
