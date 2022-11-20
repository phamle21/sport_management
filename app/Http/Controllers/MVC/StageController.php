<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{

    public function store(Request $request)
    {
        if ($request->order < 0 || $request->order > 5) {
            return redirect(route('tournament.details', ['id' => $request->league_id, 'type_show' => 'stage']))->with('error', 'Thêm giai đoạn thất bại. Số thứ tự chỉ được từ 0 đến 5');
        }

        if (League::find($request->league_id)->totalStage() > 5) {
            return redirect(route('tournament.details', ['id' => $request->league_id, 'type_show' => 'stage']))->with('error', 'Thêm giai đoạn thất bại. Bạn không được thêm quá 6 giai đoạn');
        }

        $new = Stage::create([
            'name' => $request->name,
            'order' => $request->order,
            'league_id' => $request->league_id,
        ]);

        if ($new) {
            return redirect(route('tournament.details', ['id' => $request->league_id, 'type_show' => 'stage']))->with('success', 'Đã thêm 1 giai đoạn mới');
        } else {
            return redirect(route('tournament.details', ['id' => $request->league_id, 'type_show' => 'stage']))->with('error', 'Thêm giai đoạn thất bại');
        }
    }

    public function destroy($id, Request $request)
    {
        Stage::find($id)->delete();
        return redirect(route('tournament.details', ['id' => $request->league_id, 'type_show' => 'stage']))->with('success', 'Đã xóa một giai đoạn');
    }
}
