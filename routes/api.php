<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\OptionController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\SeasonController;
use App\Http\Controllers\API\TournamentController;
use App\Http\Controllers\API\UserController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('me', 'me');
});

/** Dashboard */
Route::get('/dashboard', [DashboardController::class, 'index']);

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

// Tournament
Route::get('/create-tournament', [TournamentController::class, 'create'])->name('tournament.frmCreate');
Route::get('/find-tournament', [TournamentController::class, 'index'])->name('tournament.find');
Route::post('/create-tournament', [TournamentController::class, 'store'])->name('tournament.create');
Route::get('/tournament/{id}/details', [TournamentController::class, 'show'])->name('tournament.details');
Route::get('/pagination-tournament', [TournamentController::class, 'pagination'])->name('tournament.pagination');
