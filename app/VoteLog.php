<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteLog extends Model
{
//    protected $casts = [
//        'request' => 'json',
//        'response' => 'json',
//    ];

    protected $fillable = ['competition_id', 'user_id', 'valid', 'info', 'created_at', 'updated_at'];


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
            if (!is_string($table->votes)) $table->votes = json_encode($table->votes);
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

    public function voted($id)
    {
        foreach (json_decode($this->votes) as $vote) {
            if ($vote === $id) return true;
        }
        return false;
    }

    public function votedGroup($gid)
    {

    }

}
