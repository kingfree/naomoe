<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $casts = [
        'info' => 'json',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function competition()
    {
        return $this->group->competition;
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

}
