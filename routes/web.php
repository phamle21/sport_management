<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\MVC\HomeController;
use App\Http\Controllers\MVC\UserController;
use App\Http\Controllers\MVC\OptionController;
use App\Http\Controllers\MVC\ContactController;
use App\Http\Controllers\MVC\FacebookController;
use App\Http\Controllers\MVC\ForgotPasswordController;
use App\Http\Controllers\MVC\GoogleController;
use App\Http\Controllers\MVC\GroupController;
use App\Http\Controllers\MVC\MatchesController;
use App\Http\Controllers\MVC\StageController;
use App\Http\Controllers\MVC\TournamentController;
use App\Http\Controllers\MVC\SponsorController;
use App\Http\Controllers\MVC\TeamController;
use App\Http\Controllers\PayPalPaymentController;
use App\Models\User;
use App\Notifications\SMSNotification;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

// Bracket
Route::post('/tournament-bracket', [TournamentController::class, 'bracket']);

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

// Matches
Route::get('/matches', [MatchesController::class, 'list'])->name('matches.list');
Route::post('/matches', [MatchesController::class, 'store'])->name('matches.create');
Route::get('/matches/{id}', [MatchesController::class, 'show'])->name('matches.details');

// Teams
Route::get('/teams/list', [TeamController::class, 'list'])->name('team.list');
Route::get('/create-team', [TeamController::class, 'create'])->name('team.create');
Route::post('/create-team', [TeamController::class, 'store'])->name('team.store');

// Sponsor
Route::get('/sponsors/{league_id}', [SponsorController::class, 'index'])->name('sponsor.index');
Route::post('/sponsors', [SponsorController::class, 'processing'])->name('sponsor.processing');
Route::post('/sponsors/stripe', [SponsorController::class, 'processStripe'])->name('sponsor.processing.stripe');

// Paypal
Route::get('handle-payment', [PayPalPaymentController::class, 'handlePayment'])->name('make.payment');
Route::get('cancel-payment', [PayPalPaymentController::class, 'paymentCancel'])->name('cancel.payment');
Route::get('payment-success', [PayPalPaymentController::class, 'paymentSuccess'])->name('success.payment');

// Verify email
Route::get('/email/verify', function () {
    return view('verify.verify');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Forget password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
