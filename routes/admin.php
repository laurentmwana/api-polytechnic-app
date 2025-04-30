<?php

use App\Helpers\SpatieNameMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLevelController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminOptionController;
use App\Http\Controllers\Admin\AdminFacultyController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminProfessorController;
use App\Http\Controllers\Admin\AdminProgrammeController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminUniversityController;
use App\Http\Controllers\Admin\AdminYearAcademicController;

Route::prefix('admin')
    ->middleware(['auth', SpatieNameMiddleware::admin()])
    ->name('#~')->group(function () {

        Route::apiResource('university', AdminUniversityController::class)
            ->parameter('university', 'id')
            ->except(['create', 'destroy', 'store']);

        Route::apiResource('faculty', AdminFacultyController::class)
            ->parameter('faculty', 'id')
            ->except(['create', 'destroy', 'store']);

        Route::apiResource('department', AdminDepartmentController::class)
            ->parameter('department', 'id');

        Route::apiResource('option', AdminOptionController::class)
            ->parameter('option', 'id');

        Route::apiResource('level', AdminLevelController::class)
            ->parameter('level', 'id');

        Route::apiResource('programme', AdminProgrammeController::class)
            ->parameter('programme', 'id');

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
