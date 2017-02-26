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
        'provider', 'provider_id',
        'user_id', 'access_token',
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

    public static function duoshuo($user_id)
    {
        return User::where('user_id', $user_id)->first();
    }

    public function hiddenName()
    {
        if ($isValid = filter_var($this->name, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $arr = explode('.', $this->name);
            $arr[1] = '*';
            $arr[2] = '*';
            return join('.', $arr);
        } else if ($isValid = filter_var($this->name, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $arr = explode(':', $this->name);
            $len = count($arr);
            return $arr[0] . ':*:*:' . $arr[$len - 1];
        }
        return $this->name;
    }
}
