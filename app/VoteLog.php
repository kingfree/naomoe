<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VoteLog extends Model
{
    protected $fillable = ['competition_id', 'user_id', 'valid', 'info', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
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

    public function headers()
    {
        return json_decode($this->header, true) ?? [];
    }

    public function bodies()
    {
        return json_decode($this->body, true) ?? [];
    }

    public function vote()
    {
        return json_decode($this->votes ?? '[]') ?? [];
    }

    public function options()
    {
        return Option::find($this->vote());
    }

    public static function getLog($compId)
    {
        $user = Auth::user();
        if ($user) {
            $log = VoteLog::firstOrNew([
                'user_id' => $user->id,
                'competition_id' => $compId
            ]);
        } else {
            $log = new VoteLog;
        }
        return $log;
    }

    public function voted($id)
    {
        foreach ($this->vote() as $vote) {
            if ($vote === $id) return true;
        }
        return false;
    }

    public function votedGroup($gid)
    {

    }
}
