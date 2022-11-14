<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rule',
        'start',
        'end',
        'prize',
        'league_type_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
