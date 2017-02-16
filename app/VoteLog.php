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

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function request()
    {
        return json_decode($this->request, true) ?? [];
    }

    public function response()
    {
        return json_decode($this->response, true) ?? [];
    }
}
