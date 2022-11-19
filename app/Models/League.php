<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'notify',
        'description',
        'start',
        'end',
        'prize',
        'league_type_id',
        'user_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function type()
    {
        return LeagueType::find($this->league_type_id);
    }

    public function typeName()
    {
        return LeagueType::find($this->league_type_id)->name;
    }

    public function groups()
    {
        return Stage::where('league_id', $this->id)->get();
    }

    public function totalStage()
    {
        return Stage::where('league_id', $this->id)->get()->count();
    }

    public function totalGroup()
    {
        $total = 0;
        $stage =  Stage::where('league_id', $this->id)->get();
        foreach ($stage as $v) {
            $total += Group::where('stage_id', $v->id)->get()->count();
        }
        return $total;
    }

    public function totalMatch()
    {
        $total = 0;
        $stages =  Stage::where('league_id', $this->id)->get();
        foreach ($stages as $stage) {
            $groups = Group::where('stage_id', $stage->id)->get();
            foreach ($groups as $group) {
                $total += Matches::where('group_id', $group->id)->get()->count();
            }
        }
        return $total;
    }


    public function totalTeam()
    {
        return Participate::where('league_id', $this->id)->get()->count();
    }
}
