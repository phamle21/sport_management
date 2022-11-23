<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function list()
    {
        $list = Team::all();
        return response()->json($list);
    }
}
