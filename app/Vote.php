<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
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
}
