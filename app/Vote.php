<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
//    protected $casts = [
//        'info' => 'json',
//    ];
    protected $fillable = ['vote_log_id', 'user_id', 'option_id', 'valid', 'weight'];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function competition()
    {
        return $this->option->competition;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
}
