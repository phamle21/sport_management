<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OptionController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\SeasonController;
use App\Http\Controllers\API\UserController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('me', 'me');
});

/** Club */
Route::resource('clubs', CourseController::class);

/** User */
Route::resource('users', UserController::class);
Route::post('/users/check-account', [UserController::class, 'checkAccount']);
Route::post('/users/update/{id}/{field}', [UserController::class, 'updateField']);
Route::post('/users/delete-list', [UserController::class, 'deleteList']);

/** Roles */
Route::resource('roles', RoleController::class);

/** Seasons */
Route::resource('seasons', SeasonController::class);

/** Options */
Route::resource('options', OptionController::class);
