<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $table = 'followers';
    protected $fillable = ['travel_id','user_id','follower_user_id']; 


    public function travels()
    {
        return $this->belongsToMany('App/travel');
    }
}