<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\MVC\HomeController;
use App\Http\Controllers\MVC\UserController;
use App\Http\Controllers\MVC\OptionController;
use App\Http\Controllers\MVC\ContactController;
use App\Http\Controllers\MVC\TournamentController;

// Goto admin page ReactJs
Route::get('/sport-admin', function () {
    return redirect()->to('http://localhost:2104/admin');
});


// Change languages
Route::get('/languages/{language}', function ($language) {
    if (!in_array($language, ['en', 'vi'])) {
        // abort(404);
        return redirect('page-not-found');
    }

    Session::put('website_language', $language);

    return redirect()->back();
})->name('settings.change-language');


// Home
Route::get('/', [HomeController::class, 'index']);

// About
Route::get('/about', [HomeController::class, 'about']);

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

// Ckeditor
Route::post('image-upload', [TournamentController::class, 'storeImage'])->name('image.upload');
