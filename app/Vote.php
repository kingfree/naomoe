<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
//    protected $casts = [
//        'info' => 'json',
//    ];

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

    public function infos()
    {
        return json_decode($this->info, true) ?? [];
    }
}
