<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Comments extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'thread_id', 'user_id','comments'
    ];

    public function thread() {
    	return $this->belongsTo('App\Model\Thread');
    }
}
