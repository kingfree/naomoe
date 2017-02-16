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

    public static function boot() {
        parent::boot();

//        static::creating(function($log)  {
//            $req = $log->request();
//            $header = array_get($req, 'header');
//            $body = array_get($req, 'body');
//            $comp = array_get($body, 'competition_id');
//            $votes = array_get($body, 'votes');
//        });
    }
}
