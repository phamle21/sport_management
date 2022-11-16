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
}
