<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $casts = [
        'names' => 'json',
        'works' => 'json',
        'info' => 'json',
    ];
}
