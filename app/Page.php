<?php

namespace App;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
//    protected $casts = [
//        'info' => 'json',
//    ];

    public static function boot() {
        parent::boot();

        static::saving(function($table)  {
            $table->user_id = Admin::user()->id;
            if (!is_string($table->info)) $table->info = json_encode($table->info);
        });
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function created_by() {
        return $this->belongsTo(Administrator::class, 'user_id');
    }

    public function infos()
    {
        return json_decode($this->info, true) ?? [];
    }

    protected $appends = ['text'];
    public function getTextAttribute()
    {
        return $this->title;
    }
}
