<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleGround extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time',
        'ground_id',
        'price',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
