<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\Participate;
use App\Models\PlayerTeam;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified', 'auth']);
    }

    public function list()
    {
        $list = Auth::user()->myTeams;
        return response()->json($list);
    }

    public function create()
    {
        return view('client.team.create');
    }

    public function store(Request $request)
    {
        // kiểm tra có files sẽ xử lý
        if ($request->hasFile('image_logo')) {
            $allowedfileExtension = ['jpg', 'jpeg', 'tiff', 'psd', 'eps', 'gif', 'png', 'raw', 'svg',];
            $files = $request->file('image_logo');
            // flag xem có thực hiện lưu DB không. Mặc định là có
            $exe_flg = true;

            // kiểm tra tất cả các files xem có đuôi mở rộng đúng không
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);

                if (!$check) {
                    // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                    $exe_flg = false;
                    break;
                }
            }

            // nếu không có file nào vi phạm validate thì tiến hành lưu DB
            if ($exe_flg) {

                // Thực hiện lưu file
                $file = $request->file('image_logo');
                $extension = $file->getClientOriginalExtension();

                $storagePath = Storage::put('public/team/logo', $file);
                $path_logo = 'storage/team/logo/' . basename($storagePath);
            } else {
                return redirect(route('team.create'))->with('error', 'Logo tải lên không đúng định dạng.');
            }
        } else {
            return redirect(route('team.create'))->with('error', 'Chưa tải lên logo.');
        }
        $new_team = Team::create([
            'name' => $request->name,
            'status' => 1,
            'logo' => $path_logo,
            'user_id' => Auth::user()->id,
        ]);

        foreach ($request->user_ids as $id) {
            PlayerTeam::create([
                'user_id' => $id,
                'team_id' => $new_team->id
            ]);
        }
        
        Participate::create([
            'team_id' => $new_team->id,
            'league_id' => $request->league_id,
        ]);

        if ($new_team) {
            return redirect(route('team.create'))->with('success', 'Tạo đội thành công.');
        } else {
            return redirect(route('team.create'))->with('error', 'Tạo đội thất bại.');
        }
    }
}
