<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participate extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'league_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
