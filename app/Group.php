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
