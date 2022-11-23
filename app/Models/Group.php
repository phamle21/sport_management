<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stage_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function matches(){
        return $this->hasMany(Matches::class, 'group_id');
    }
    public function stage(){
        return $this->belongsTo(Stage::class);
    }
}
