<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name', 'weekday', 'time', 'room_id', 'user_id'
    ];
}
