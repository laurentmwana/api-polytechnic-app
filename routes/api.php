<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeController;
use App\Http\Controllers\Other\LevelController;
use App\Http\Controllers\Other\OptionController;
use App\Http\Controllers\Other\ContactController;
use App\Http\Controllers\Other\EvaluatorController;
use App\Http\Controllers\Other\ProfessorController;
use App\Http\Controllers\Other\ProgrammeController;
use App\Http\Controllers\Other\DepartmentController;
use App\Http\Controllers\Other\AcademicFeesController;
use App\Http\Controllers\Other\DeliberationController;
use App\Http\Controllers\Other\NotificationController;
use App\Http\Controllers\Other\YearAcademicController;
use App\Http\Controllers\Profile\ProfileEditController;
use App\Http\Controllers\Other\LaboratoryFeesController;
use App\Http\Controllers\Profile\ProfilePasswordController;

Route::get('/me', MeController::class)->middleware('auth');

Route::name('^')->group(function () {

    Route::get('deliberation/{id}', [DeliberationController::class, 'show'])
        ->name('deliberation.show');

    Route::get('deliberation', [DeliberationController::class, 'index'])
        ->name('deliberation.index');

    Route::get('professor/{id}', [ProfessorController::class, 'show'])
        ->name('professor.show');

    Route::get('professor', [ProfessorController::class, 'index'])
        ->name('professor.index');

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


    Route::get('/evaluator', EvaluatorController::class)
        ->name('eva.index');

    Route::post('/contact/send', ContactController::class)
        ->name('contact.send');


    Route::get('/academic-fees/{id}', [AcademicFeesController::class, 'show'])
        ->name('aca.show');

    Route::get('/academic-fees', [AcademicFeesController::class, 'index'])
        ->name('aca.index');

    Route::get('/laboratory-fees/{id}', [LaboratoryFeesController::class, 'show'])
        ->name('labo.show');

    Route::get('/laboratory-fees', [LaboratoryFeesController::class, 'index'])
        ->name('labo.index');

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
