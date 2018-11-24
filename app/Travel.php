<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'travels';
    protected $fillable = ['msgInti', 'dateIn', 'dateOut', 'country', 'amount','coin','activities','city','flexibility','user_id']; 
    
     /**Aca estoy marcando trayendo al dueño del viaje? */
    
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id', 'id');
     }

    public function beFollowed()
    {
    return $this->belongsToMany('App\User', 'followers', 'follower_user_id');
    }
}

