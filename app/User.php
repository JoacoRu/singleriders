<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App/Post');
    }

    public function travels(){
        return $this->belongsToMany('app/travel');
    }

    function followers()
    {
        return $this->belongsToMany('App/User', 'followers', 'user_id', 'follower_id');
    }

    function follow(User $user) {
        $this->followers()->attach($user->id);
    }

    function unfollow(User $user) {
        $this->followers()->detach($user->id);
    }
}

