<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_name extends Model
{
    protected $table = 'course_name';

    protected $fillable = [
        'name',
    ];
}
