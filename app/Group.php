<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $casts = [
        'info' => 'json',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
