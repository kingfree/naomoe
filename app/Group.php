<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $casts = [
        'info' => 'json',
    ];
    protected $fillable = ['competition_id', 'title', 'allow', 'created_at', 'updated_at'];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    protected $appends = ['text'];
    public function getTextAttribute()
    {
        return $this->title;
    }
}
