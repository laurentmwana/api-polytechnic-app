<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeController;
use App\Http\Controllers\Other\NewsController;
use App\Http\Controllers\Other\LevelController;
use App\Http\Controllers\Other\OptionController;
use App\Http\Controllers\Other\FacultyController;
use App\Http\Controllers\Other\ProfessorController;
use App\Http\Controllers\Other\ProgrammeController;
use App\Http\Controllers\Other\DepartmentController;
use App\Http\Controllers\Other\UniversityController;
use App\Http\Controllers\Other\NotificationController;
use App\Http\Controllers\Other\YearAcademicController;
use App\Http\Controllers\Profile\ProfileEditController;
use App\Http\Controllers\Profile\ProfilePasswordController;

Route::get('/me', MeController::class)->middleware('auth');

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

    Route::get('/pending/year-academic', [YearAcademicController::class, 'pending'])
        ->name('year-academic.pending');
    Route::get('/year-academic', [YearAcademicController::class, 'index'])
        ->name('year-academic.index');

    Route::get('professor/leader', [ProfessorController::class, 'leader'])
        ->name('professor.leader');

    Route::get('/news/{id}', [NewsController::class, 'show'])
        ->name('news.show');

    Route::get('/news', [NewsController::class, 'index'])
        ->name('news.index');

    Route::middleware('auth')->group(function () {

        Route::get('/notification', [NotificationController::class, 'index'])
            ->name('notification.index');

        Route::get('/notification/{id}', [NotificationController::class, 'show'])
            ->name('notification.show');

        Route::post('/profile/edit', ProfileEditController::class)
            ->name('profile.edit');

        Route::post('/profile/change-password', ProfilePasswordController::class)
            ->name('profile.password');
    });
});
