<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
//    protected $casts = [
//        'info' => 'json',
//    ];

    protected $fillable = ['character_id', 'group_id', 'title', 'winner', 'valid', 'voted', 'created_at', 'updated_at'];

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
        $avatar = array_get($this->infos(), 'avatar', null);
        if ($avatar) return $avatar;
        $avatar = $this->character->avatar;
        if ($avatar) return $avatar;
        return $this->group->avatar() ?? '../../images/default.png';
    }

    public function music()
    {
        $info = $this->character->infos();
        return array_get($info, 'music', null);
    }

    protected $appends = ['text', 'avatar'];

    public function getTextAttribute()
    {
        return $this->title;
    }

    public function getAvatarAttribute()
    {
        return $this->avatar();
    }

}
