<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'match_date',
        'user_id',
        'indicators',
        'group_id',
        'team_id',
        'team_opposing_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
