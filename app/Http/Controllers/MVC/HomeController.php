<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
