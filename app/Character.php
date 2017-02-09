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

    protected $fillable = [
        'name', 'names', 'work', 'works', 'avatar', 'info', 'description'
    ];

    protected $appends = ['text'];

    const SOURCES = [
                    '动画' => 'TV动画',
                    'OVA' => 'OVA',
                    '剧场版' => '剧场版动画',
                    '广播剧' => '广播剧',
                    '其他' => '其他',
                ];

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
