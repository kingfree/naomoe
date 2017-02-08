<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $casts = [
        'names' => 'json',
        'works' => 'json',
        'info' => 'json',
    ];

    protected $appends = ['text'];

    public function pools()
    {
        return $this->belongsToMany(Pool::class,
            'pool_characters', 'character_id', 'pool_id')
            ->withTimestamps();
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function getTextAttribute()
    {
        return $this->name . '@' . $this->work;
    }
}
