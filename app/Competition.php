<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
//    protected $casts = [
//        'info' => 'json',
//    ];

    const WILL = 0, DOING = 1, DID = 2;

    protected $dates = ['start_at', 'end_at'];

    public function groups()
    {
        return $this->hasMany(Group::class)->orderBy('order');
    }

    public function votelogs()
    {
        return $this->hasMany(VoteLog::class)->orderBy('created_at');
    }

    public function votelogsDesc()
    {
        return $this->hasMany(VoteLog::class)->orderBy('created_at', 'desc');
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

    public function state()
    {
        $now = Carbon::now();
        if ($now->lt($this->start_at)) return self::WILL;
        if ($now->lte($this->end_at)) return self::DOING;
        return self::DID;
    }

    public function isMusic()
    {
        return array_get($this->infos(), 'music', null);
    }

    public static function getNewestDoing()
    {
        $now = Carbon::now();
        return Competition::where('start_at', '<=', $now)
            ->where('end_at', '>=', $now)
            ->orderBy('start_at', 'desc')
            ->first();
    }

    public static function getNewestWill()
    {
        $now = Carbon::now();
        return Competition::where('start_at', '>=', $now)
            ->orderBy('start_at', 'asc')
            ->first();
    }

    public static function getNewestDid()
    {
        $now = Carbon::now();
        return Competition::where('start_at', '<=', $now)
            ->where('end_at', '>=', $now)
            ->orderBy('end_at', 'desc')
            ->first();
    }

    protected $appends = ['text', 'status'];

    public function getTextAttribute()
    {
        return $this->title;
    }

    public function getStatusAttribute()
    {
        return $this->state();
    }
}
