<?php

namespace App;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $casts = [
        'info' => 'json',
    ];

    public static function boot() {
        parent::boot();

        static::saving(function($table)  {
            $table->user_id = Admin::user()->id;
        });
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function created_by() {
        return $this->belongsTo(Administrator::class, 'user_id');
    }
}
