<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Character extends Model
{
    protected $casts = [
        'names' => 'json',
        'works' => 'json',
        //'info' => 'json',
    ];

    protected $fillable = [
        'name', 'names', 'work', 'works', 'avatar', 'info', 'description'
    ];

    const SOURCES = [
        '动画' => 'TV动画',
        'OVA' => 'OVA',
        '剧场版动画' => '剧场版动画',
        '广播剧' => '广播剧',
        '其他' => '其他',
    ];

    const SOURCES_ja = [
        '动画' => 'テレビアニメ',
        'OVA' => 'OVA',
        '剧场版动画' => '劇場版アニメ',
        '广播剧' => 'ラジオ番組',
        '其他' => 'その他',
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

    protected $appends = ['text', 'lname', 'lwork', 'source'];

    public function getTextAttribute()
    {
        return $this->name . '@' . $this->work;
    }

    public function getLnameAttribute()
    {
        if ($this->names) {
            $name = array_get($this->names, App::getLocale(), $this->name);
            if (!empty($name)) return $name;
        }
        return $this->name;
    }

    public function getLworkAttribute()
    {
        if ($this->works) {
            $work = array_get($this->works, App::getLocale(), $this->work);
            if (!empty($work)) return $work;
        }
        return $this->work;
    }

    public function getSourceAttribute()
    {
        $sources = $this->infos()['source'] ?? [];
        if (App::getLocale() === 'ja') return array_map(function ($e) {
            return array_get(self::SOURCES_ja, $e, $e);
        }, $sources);
        return $sources;
    }
}
