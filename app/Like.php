<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'Like';
    protected $fillable = ['user_id', 'post_id'];

    public function posts()
    {
        return $this->belongsToMany('App/Post');
    }
}
