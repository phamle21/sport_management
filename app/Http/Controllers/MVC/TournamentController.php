<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\League;
use App\Models\LeagueType;
use App\Models\MatchDetail;
use App\Models\Matches;
use App\Models\Sponsorship;
use App\Models\Stage;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TournamentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified', 'auth'])->except(['index', 'show', 'bracket', 'showMatches']);
    }

    public function index(Request $request)
    {
        $tournaments = League::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->search)) {
                    $types = LeagueType::where('name', 'LIKE', '%' . $s . '%')->get();
                    if (count($types) > 0) {
                        foreach ($types as $type) {
                            $query->orWhere('name', 'LIKE', '%' . $s . '%')
                                ->orWhere('start', 'LIKE', '%' . $s . '%')
                                ->orWhere('end', 'LIKE', '%' . $s . '%')
                                ->orWhere('league_type_id', 'LIKE', '%' . $type->id . '%')
                                ->get();
                        }
                    } else {
                        $query->orWhere('name', 'LIKE', '%' . $s . '%')
                            ->orWhere('start', 'LIKE', '%' . $s . '%')
                            ->orWhere('end', 'LIKE', '%' . $s . '%')
                            ->get();
                    }
                }
            }]
        ])->paginate(isset($request->pageSize) ? $request->pageSize : 10);

        return view('client.tournament.find', compact('tournaments'));
    }

    public function myindex(Request $request, $id)
    {
        $tournaments = League::where([
            ['name', '!=', Null],
            ['user_id', '=', $id],
            [function ($query) use ($request) {
                if (($s = $request->search)) {
                    $types = LeagueType::where('name', 'LIKE', '%' . $s . '%')->get();
                    if (count($types) > 0) {
                        foreach ($types as $type) {
                            $query->orWhere('name', 'LIKE', '%' . $s . '%')
                                ->orWhere('start', 'LIKE', '%' . $s . '%')
                                ->orWhere('end', 'LIKE', '%' . $s . '%')
                                ->orWhere('league_type_id', 'LIKE', '%' . $type->id . '%')
                                ->get();
                        }
                    } else {
                        $query->orWhere('name', 'LIKE', '%' . $s . '%')
                            ->orWhere('start', 'LIKE', '%' . $s . '%')
                            ->orWhere('end', 'LIKE', '%' . $s . '%')
                            ->get();
                    }
                }
            }]
        ])->paginate(isset($request->pageSize) ? $request->pageSize : 10);

        return view('client.tournament.find', compact('tournaments'));
    }

    public function create()
    {
        $league_type_list = LeagueType::all();
        return view('client.tournament.create', compact('league_type_list'));
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

                $storagePath = Storage::put('public/tournament/logo', $file);
                $path_logo = 'storage/tournament/logo/' . basename($storagePath);
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
            'description' => $request->description,
            'start' => date('Y-m-d', strtotime($request->start)),
            'end' => date('Y-m-d', strtotime($request->end)),
            'prize' => $request->prize,
            'league_type_id' => $type,
            'user_id' => Auth::user()->id,
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

    public function show($id, Request $request)
    {
        if (!League::whereId($id)->exists()) {
            return abort(404);
        }
        $tournament = League::find($id);
        $tournament->total_stage = $tournament->totalStage();
        $tournament->total_group = $tournament->totalGroup();
        $tournament->total_match = $tournament->totalMatch();
        $tournament->total_team = $tournament->totalTeam();

        $stages = Stage::where('league_id', $tournament->id)->get();

        $list_all_group = [];

        foreach ($stages as $v) {
            $groups = Group::where('stage_id', $v->id)->get();

            foreach ($groups as $group) {
                $group->matches;
                $group->stage;
                $list_all_group[] = $group;
            }
            $v->groups = $groups;
        }

        if (isset($request->type_show) && $request->type_show != null) {
            $tournament->type_show = $request->type_show;
        } else {
            $tournament->type_show = 'about';
        }

        $sponsorship_list = Sponsorship::where('league_id', $id)->get();
        $sponsor_list = [];
        foreach ($sponsorship_list as $v) {
            $v->sponsors;
            $sponsor_list[] = $v->sponsors;
        }
        $sponsor_list = array_unique($sponsor_list);

        return view('client.tournament.details', compact('tournament', 'stages', 'sponsor_list', 'list_all_group'));
    }

    public function bracket(Request $request)
    {
        $data = [];
        $rounds = [];

        $tournament = League::find($request->league_id);
        $tournament->total_stage = $tournament->totalStage();
        $tournament->total_group = $tournament->totalGroup();
        $tournament->total_match = $tournament->totalMatch();
        $tournament->total_team = $tournament->totalTeam();

        $stages = Stage::where('league_id', $tournament->id)->get();

        $list_all_group = [];
        $count = 1;

        foreach ($stages as $k => $v) {
            $rounds[] = $v->name;
            $data[$k] = [];

            $groups = Group::where('stage_id', $v->id)->get();

            foreach ($groups as $k_group => $group) {
                $group->matches;
                $group->stage;
                $list_all_group[] = $group;

                if (count($group->matches) > 0) :

                    foreach ($group->matches as $match) {
                        // $team1 = MatchDetail::where([
                        //     ['match_id', $match->id],
                        //     ['team_id', $match->team_id]
                        // ])->first();
                        // $diem1 = 0;
                        // if (is_array($team1->indicators)) {
                        //     foreach ($team1->indicators as $v) {
                        //         if ($v['key'] == "Điểm") {
                        //             $diem1 = $v['value'];
                        //         }
                        //     }
                        // }

                        // $team2 = MatchDetail::where([
                        //     ['match_id', $match->id],
                        //     ['team_id', $match->team_opposing_id]
                        // ])->first();
                        // $diem2 = 0;
                        // if (is_array($team2->indicators)) {
                        //     foreach ($team2->indicators as $v) {
                        //         if ($v['key'] == "Điểm") {
                        //             $diem2 = $v['value'];
                        //         }
                        //     }
                        // }

                        $data[$k][] = [
                            [
                                "name" => $match->team_id ? Team::find($match->team_id)->name : '',
                                "id" => "team-" . $match->team_id,
                                "score" => $count
                            ],
                            [
                                "name" => $match->team_opposing_id ? Team::find($match->team_opposing_id)->name : '',
                                "id" => "team-" . $match->team_opposing_id,
                                "score" => $count + 1
                            ],
                        ];

                        $count += 2;
                    }
                else :
                    $data[$k][] = [[
                        "name" => 'Undefine',
                        "id" => '',
                        "score" => ''
                    ], [
                        "name" => 'Undefine',
                        "id" => '',
                        "score" => ''
                    ]];
                endif;
            }
            $v->groups = $groups;
        }

        $rounds[] = "W I N";

        $data[] = [
            [
                [
                    "name" => 'Team Win',
                    "id" => 'team-win',
                    "score" => ''
                ]
            ]
        ];

        return response()->json([
            'rounds' => $rounds,
            'data' => $data,
        ]);
    }

    public function showMatches($id, $match_id)
    {
        $tournament = League::find($id);
        $match = Matches::find($match_id);
        $team1 = Team::find($match->team_id);
        $team2 = Team::find($match->team_opposing_id);

        if (!isset($match->indicators)) {
            Matches::whereId($match_id)->update([
                'indicators' => serialize([]),
            ]);
        }
        $match->indicators = unserialize($match->indicators);


        $team1_details = MatchDetail::where([
            ['matches_id', $match->id],
            ['team_id', $team1->id]
        ])->first();

        if (!$team1_details) {
            $team1_details->indicators = [];
        }
        $team1_details->indicators = unserialize($team1_details->indicators);


        $team2_details = MatchDetail::where([
            ['matches_id', $match->id],
            ['team_id', $team2->id]
        ])->first();

        if (!$team2_details) {
            $team2_details->indicators = [];
        }
        $team2_details->indicators = unserialize($team2_details->indicators);


        return view('client.tournament.matches', compact(
            'tournament',
            'match',
            'team1',
            'team2',
            'team1_details',
            'team2_details',
        ));
    }

    public function deleteKeyMatch($match_id, $key)
    {
        $match = Matches::find($match_id);

        $indicator_old = unserialize($match->indicators);

        foreach ($indicator_old as $k => $v) {
            if ($v['key'] == $key) {
                unset($indicator_old[$k]);
            }
        }
        Matches::whereId($match_id)->update([
            'indicators' => serialize($indicator_old),
        ]);
        return back()->with('success', 'Đã xóa một chỉ số');
    }

    public function newKeyMatch($match_id, Request $request)
    {

        $match = Matches::find($match_id);

        $indicator_old = unserialize($match->indicators);

        $indicator_old[] = [
            'key' => $request->key_indicator,
            'value' => $request->value_indicator,
        ];

        Matches::whereId($match_id)->update([
            'indicators' => serialize($indicator_old),
        ]);

        return back()->with('success', 'Thêm thành công chỉ số mới');
    }

    public function newKeyTeam($match_id, Request $request)
    {

        $team_detail = MatchDetail::where([
            ['matches_id', $match_id],
            ['team_id', $request->team_id]
        ])->first();

        $indicator_old = unserialize($team_detail->indicators);

        $indicator_old[] = [
            'key' => $request->key_indicator,
            'value' => $request->value_indicator,
        ];

        MatchDetail::where([
            ['matches_id', $match_id],
            ['team_id', $request->team_id]
        ])->update([
            'indicators' => serialize($indicator_old),
        ]);

        return back()->with('success', 'Thêm thành công chỉ số mới');
    }

    public function deleteKeyTeam($match_id, $key,  Request $request)
    {
        $team_detail = MatchDetail::find($request->team_id);

        $indicator_old = unserialize($team_detail->indicators);

        foreach ($indicator_old as $k => $v) {
            if ($v['key'] == $key) {
                unset($indicator_old[$k]);
            }
        }

        MatchDetail::whereId($request->team_id)->update([
            'indicators' => serialize($indicator_old),
        ]);

        return back()->with('success', 'Đã xóa một chỉ số');
    }
}
