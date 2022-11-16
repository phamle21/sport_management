<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('client.index.index');
    }

    public function about()
    {
        return view('client.about.about');
    }

    public function login()
    {

        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('client.auth.login');
    }

    public function loginSubmit()
    {
    }

    public function register()
    {
        return view('client.auth.register');
    }

    public function registerSubmit()
    {
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
