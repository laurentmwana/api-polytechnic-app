<?php

use App\Helpers\SpatieNameMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Other\LevelController;
use App\Http\Controllers\Other\OptionController;
use App\Http\Controllers\Other\FacultyController;
use App\Http\Controllers\Other\ProgrammeController;
use App\Http\Controllers\Admin\AdminLevelController;
use App\Http\Controllers\Other\DepartmentController;
use App\Http\Controllers\Other\UniversityController;
use App\Http\Controllers\Admin\AdminOptionController;
use App\Http\Controllers\Admin\AdminFacultyController;
use App\Http\Controllers\Other\YearAcademicController;
use App\Http\Controllers\Admin\AdminProgrammeController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminUniversityController;
use App\Http\Controllers\Admin\AdminYearAcademicController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('admin')
    ->middleware(['auth:sanctum', SpatieNameMiddleware::admin()])
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
    });

Route::name('^')->group(function () {

    Route::get('university/{id}', [UniversityController::class, 'show'])
        ->name('university.show');
    Route::get('university', [UniversityController::class, 'index'])
        ->name('university.index');

    Route::get('faculty/{id}', [FacultyController::class, 'show'])
        ->name('faculty.show');
    Route::get('faculty', [FacultyController::class, 'index'])
        ->name('faculty.index');

    Route::get('department/{id}', [DepartmentController::class, 'show'])
        ->name('department.show');
    Route::get('department', [DepartmentController::class, 'index'])
        ->name('department.index');

    Route::get('option/{id}', [OptionController::class, 'show'])
        ->name('option.show');
    Route::get('option', [OptionController::class, 'index'])
        ->name('option.index');

    Route::get('level/{id}', [LevelController::class, 'show'])
        ->name('level.show');
    Route::get('level', [LevelController::class, 'index'])
        ->name('level.index');

    Route::get('programme/{id}', [ProgrammeController::class, 'show'])
        ->name('programme.show');
    Route::get('programme', [ProgrammeController::class, 'index'])
        ->name('programme.index');

    Route::get('/year-academic/{id}', [YearAcademicController::class, 'show'])
        ->name('year-academic.show');
    Route::get('/year-academic', [YearAcademicController::class, 'index'])
        ->name('year-academic.index');
});

require __DIR__ . '/auth.php';
