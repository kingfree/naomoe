<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
        'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function vote_logs()
    {
        return $this->hasMany(VoteLog::class);
    }

    public function hiddenName()
    {
        if (!$this->password) {
            $arr = explode('.', $this->name);
            $arr[1] = '*';
            $arr[2] = '*';
            return join('.', $arr);
        }
        return $this->name;
    }
}
