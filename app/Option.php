<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $casts = [
        'info' => 'json',
    ];
    protected $fillable = ['character_id', 'group_id', 'title', 'valid', 'voted', 'created_at', 'updated_at'];

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

    protected $appends = ['text'];
    public function getTextAttribute()
    {
        return $this->title;
    }

}
