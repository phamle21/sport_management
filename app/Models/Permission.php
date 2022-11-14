<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
