<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
//    protected $casts = [
//        'info' => 'json',
//    ];

    public function groups()
    {
        return $this->hasMany(Group::class)->orderBy('order');
    }

    public function options()
    {
        return $this->hasManyThrough(Option::class, Group::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function infos()
    {
        return json_decode($this->info, true) ?? [];
    }

    public function icon()
    {
        return $this->infos()['icon'] ?? 'upload';
    }

    protected $appends = ['text'];
    public function getTextAttribute()
    {
        return $this->title;
    }
}
