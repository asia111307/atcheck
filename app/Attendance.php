<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'classes_id', 'student_id_number', 'student_name', 'student_surname', 'seat_number', 'notes'
    ];
}
