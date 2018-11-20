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
}

