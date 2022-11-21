<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'introduce',
        'user_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'laravel_through_key',
    ];
}
