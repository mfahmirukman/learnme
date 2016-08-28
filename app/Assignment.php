<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignments';

    protected $fillable = [
        'courses_id', 'creator_id', 'for_class_id','title', 'link'
    ];
}
