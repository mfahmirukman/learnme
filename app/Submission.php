<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submissions';

    protected $fillable = [
        'courses_id', 'creator_id', 'for_class_id','title', 'link'
    ];

}
