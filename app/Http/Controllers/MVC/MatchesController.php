<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    public function store(Request $request)
    {
    }

    public function list()
    {
        $list = Matches::all();
        return response()->json($list);
    }
}
