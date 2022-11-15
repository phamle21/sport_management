<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\LeagueType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TournamentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        return view('client.tournament.find-tournament');
    }

    public function create()
    {
        $league_type_list = LeagueType::all();
        return view('client.tournament.create-tournament', compact('league_type_list'));
    }

    public function store(Request $request)
    {
        if (LeagueType::whereId($request->type)->exists()) {
            $type = $request->type;
        } elseif (LeagueType::where('name', '=', $request->type)->exists()) {
            $type = LeagueType::where('name', '=', $request->type)->first()->id;
        } else {
            $new_type = LeagueType::create(['name' => $request->type]);
            $type = $new_type->id;
        }

        // kiểm tra có files sẽ xử lý
        if ($request->hasFile('image')) {
            $allowedfileExtension = ['jpg', 'jpeg', 'tiff', 'psd', 'eps', 'gif', 'png', 'raw', 'svg',];
            $files = $request->file('image');
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
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();

                Storage::put('public/tournament/logo', $file);
                $path_logo = 'storage/tournament/logo/' . $file;
            } else {
                return redirect(route('tournament.frmCreate'))->with('error', 'Logo tải lên không đúng định dạng.');
            }
        } else {
            return redirect(route('tournament.frmCreate'))->with('error', 'Chưa tải lên logo.');
        }

        $new_tournament = League::create([
            'name' => $request->name,
            'logo' => $path_logo,
            'notify' => $request->notify,
            'start' => date('Y-m-d', strtotime($request->start)),
            'end' => date('Y-m-d', strtotime($request->end)),
            'prize' => $request->prize,
            'league_type_id' => $type,
        ]);

        if ($new_tournament) {
            return redirect(route('tournament.details', ['id' => $new_tournament->id]))->with('success', 'Tạo giải đấu thành công. Hãy tiến hành tạo các giai đoạn và bảng đấu.');
        } else {
            return redirect(route('tournament.frmCreate'))->with('error', 'Tạo giải đấu thất bại.');
        }
    }

    public function storeImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('storage/ckeditor-media'), $fileName);

            $url = asset('storage/ckeditor-media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function show($id)
    {
        if (!League::whereId($id)->exists()) {
            return abort(404);
        }
        $tournament = League::find($id);
        $tournament->total_stage = 0;
        $tournament->total_group = 0;
        $tournament->total_match = 0;
        $tournament->total_team = 0;

        return view('client.tournament.details-tournament', compact('tournament'));
    }
}
