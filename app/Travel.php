<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{

    protected $fillable = [
        'dateIn', 'dateOut', 'activities', 'country', 'city', 'msgIti', 'amount', 'coin', 'travel_creator',
    ];

    public function users()
    {
    	//return $this->belongsToMany(Actor::class, 'tabla_de_relacion', 'foreing_key', 'id');
    	return $this->belongsToMany(User::class);
    }
}
