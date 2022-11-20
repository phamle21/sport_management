<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\MVC\HomeController;
use App\Http\Controllers\MVC\UserController;
use App\Http\Controllers\MVC\OptionController;
use App\Http\Controllers\MVC\ContactController;
use App\Http\Controllers\MVC\FacebookController;
use App\Http\Controllers\MVC\GoogleController;
use App\Http\Controllers\MVC\GroupController;
use App\Http\Controllers\MVC\SponsorController as MVCSponsorController;
use App\Http\Controllers\MVC\StageController;
use App\Http\Controllers\MVC\TournamentController;
use App\Http\Controllers\MVC\SponsorController;
use Illuminate\Support\Facades\Auth;

// Goto admin page ReactJs
Route::get('/sport-admin', function () {
    return redirect()->to('http://localhost:2104/admin');
});


// Change languages
Route::get('/languages/{language}', function ($language) {
    if (!in_array($language, ['en', 'vi'])) {
        abort(404);
    }

    Session::put('website_language', $language);

    return redirect()->back();
})->name('settings.change-language');


// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login', [HomeController::class, 'loginSubmit'])->name('login.submit');

Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register', [HomeController::class, 'registerSubmit'])->name('register.submit');

Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

// About
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendContact'])->name('contact.send');

// Import
Route::get('/import-users', [UserController::class, 'import']);
Route::get('/import-options', [OptionController::class, 'import']);

// Tournament
Route::get('/find-tournament', [TournamentController::class, 'index'])->name('tournament.find');
Route::get('/create-tournament', [TournamentController::class, 'create'])->name('tournament.frmCreate');
Route::post('/create-tournament', [TournamentController::class, 'store'])->name('tournament.create');
Route::get('/tournament/{id}/details', [TournamentController::class, 'show'])->name('tournament.details');

// Ckeditor
Route::post('image-upload', [TournamentController::class, 'storeImage'])->name('image.upload');

// Login Facebook
Route::controller(FacebookController::class)->group(function () {
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});

// Login Google
Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

// Stage
Route::post('/stages', [StageController::class, 'store'])->name('stage.create');
Route::delete('/stages/{id}', [StageController::class, 'destroy'])->name('stage.delete');

// Group
Route::post('/groups', [GroupController::class, 'store'])->name('group.create');

// Sponsor
Route::get('/sponsors', [SponsorController::class, 'index'])->name('sponsor.index');
