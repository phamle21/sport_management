<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'matches_id',
        'team_id',
        'indicators',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
