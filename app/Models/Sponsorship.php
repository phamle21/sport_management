<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sponsor_amount',
        'sponsor_oder_id',
        'sponsor_status',
        'sponsor_link',
        'sponsor_method',
        'sponsor_id',
        'league_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function sponsors(){
        return $this->belongsTo(Sponsor::class, 'sponsor_id');
    }
}
