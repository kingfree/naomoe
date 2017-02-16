<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteLog extends Model
{
//    protected $casts = [
//        'request' => 'json',
//        'response' => 'json',
//    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($table) {
            if (!is_string($table->header)) $table->header = json_encode($table->header);
            if (!is_string($table->body)) $table->body = json_encode($table->body);
        });
    }

    public function header()
    {
        return json_decode($this->header, true) ?? [];
    }

    public function body()
    {
        return json_decode($this->body, true) ?? [];
    }

}
