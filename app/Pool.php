<?php

namespace App;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{

    public static function boot() {
        parent::boot();

        static::saving(function($table)  {
            $table->user_id = Admin::user()->id;
        });
    }

    public function characters() {
        return $this->belongsToMany(Character::class,
            'pool_characters', 'pool_id', 'character_id')
            ->withTimestamps();
    }

    public function created_by() {
        return $this->belongsTo(Administrator::class, 'user_id');
    }

    protected $appends = ['text'];
    public function getTextAttribute()
    {
        return $this->title;
    }
}
