<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MVC\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/sport-admin', function () {
    return redirect()->to('http://localhost:2104/admin');
});

Route::get('/', [HomeController::class, 'index']);

