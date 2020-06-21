<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = [
        'subject_id', 'date', 'classes_code', 'mode'
    ];
}
