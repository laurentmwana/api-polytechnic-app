<?php

use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminFacultyController;
use App\Http\Controllers\Admin\AdminUniversityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('admin')->name('#~')->group(function () {

    Route::apiResource('university', AdminUniversityController::class)
        ->parameter('university', 'id')
        ->except(['create', 'destroy']);

    Route::apiResource('faculty', AdminFacultyController::class)
        ->parameter('faculty', 'id')
        ->except(['create', 'destroy']);

    Route::apiResource('department', AdminDepartmentController::class)
        ->parameter('department', 'id');
});
