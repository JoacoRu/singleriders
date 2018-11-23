<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'travels';
    protected $fillable = ['msgInti', 'dateIn', 'dateOut', 'country', 'amount','coin','activities','city','flexibility']; 

    /**Aca estoy marcando trayendo al dueño del viaje? */
    public function myOwnTravels(){
        return $this->belongsTo('App\User','travel_creator','travel_id');
    }
    

}

