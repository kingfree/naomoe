<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
//    protected $casts = [
//        'info' => 'json',
//    ];
    protected $fillable = ['competition_id', 'title', 'allow', 'info', 'created_at', 'updated_at'];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class)->orderBy('character_id');
    }

    public function rank() {
        return $this->hasMany(Option::class)->orderBy('valid', 'desc')->orderBy('character_id');
    }

    public function rankLimit() {
        return $this->hasMany(Option::class)->orderBy('valid', 'desc')->orderBy('character_id')->limit($this->allow);
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

    public function avatar()
    {
        return array_get($this->infos(), 'avatar', null);
    }

    protected $appends = ['text'];
    public function getTextAttribute()
    {
        return $this->title;
    }
}
