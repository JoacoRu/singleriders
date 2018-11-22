<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'Travels';
    protected $fillable = ['msgInti', 'dateIn', 'dateOut', 'country', 'amount','coin','activities','city','flexibility']; 

    public function travels (){
        return $this->belongsToMany(User::class);
    }
        /** Usuarios que siguen a este usuario (esto para traer los que siguen a mi viaje) followers= quienes me siguen a mi */
    public function followers(){
        return $this->belongsToMany(User::class, 'follows', 'travel_id', 'followed_id', 'follower_id');
    }
}

