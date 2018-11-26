<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'post', 
    ];

    public function users()
    {
        return $this->belongsTo('App/User');
    }

    public function likes()
    {
        return $this->hasMany('App/Like');
    }

    public function comments()
    {
        return $this->hasMany('App/Comment');
    }
}
