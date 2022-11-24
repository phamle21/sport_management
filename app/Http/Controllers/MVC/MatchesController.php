<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['list']);
    }

    public function store(Request $request)
    {
        $teamName = Team::find($request->team_id)->name;
        $teamOpposingName = Team::find($request->team_opposing_id)->name;
        $nameMatches = "$teamName vs $teamOpposingName";

        $add = Matches::create([
            'name' => $nameMatches,
            'location' => $request->location,
            'match_date' => $request->match_date,
            'user_id' => Auth::user()->id,
            'group_id' => $request->group_id,
            'team_id' => $request->team_id,
            'team_opposing_id' => $request->team_opposing_id,
        ]);

        if ($add) {
            return redirect(route('tournament.details', ['id' => $request->league_id, 'type_show' => 'group']))->with('success', 'Đã thêm 1 trận đấu mới');
        } else {
            return redirect(route('tournament.details', ['id' => $request->league_id, 'type_show' => 'group']))->with('error', 'Thêm trận đấu thất bại');
        }
    }

    public function list()
    {
        $list = Matches::all();
        return response()->json($list);
    }
}
