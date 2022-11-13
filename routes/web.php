<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\MVC\HomeController;
use Illuminate\Support\Facades\Session;



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
