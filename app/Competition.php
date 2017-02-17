<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
//    protected $casts = [
//        'info' => 'json',
//    ];

    protected $dates = ['start_at', 'end_at'];

    public function groups()
    {
        return $this->hasMany(Group::class)->orderBy('order');
    }

    public function votelogs()
    {
        return $this->hasMany(VoteLog::class)->orderBy('created_at');
    }

    public function options()
    {
        return $this->hasManyThrough(Option::class, Group::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($table) {
            if (!is_string($table->info)) $table->info = json_encode($table->info);
        });
    }

    public function infos()
    {
        return json_decode($this->info, true) ?? [];
    }

    public function icon()
    {
        return $this->infos()['icon'] ?? 'upload';
    }

    public function inTime()
    {
        $now = Carbon::now();
        return $now->gte($this->start_at) && $now->lte($this->end_at);
    }

    protected $appends = ['text'];

    public function getTextAttribute()
    {
        return $this->title;
    }
}
