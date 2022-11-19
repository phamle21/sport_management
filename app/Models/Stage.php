<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order',
        'league_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
