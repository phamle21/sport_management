<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Stage;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function store(Request $request)
    {
        Group::create([
            'name' => $request->name,
            'stage_id' => $request->stage_id,
        ]);

        return redirect(route('tournament.details', ['id' => $request->league_id, 'type_show' => 'stage']))
            ->with('success', 'Đã thêm một bảng đấu cho giai đoạn ' . Stage::find($request->stage_id)->name);
    }
}
