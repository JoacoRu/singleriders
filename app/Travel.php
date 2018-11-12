<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'Travels';
    protected $fillable = ['textmensaje', 'datein', 'dateout', 'pais', 'importe','moneda']; // cambiar igual que esta en la base de datos//

    public function travels (){
        return $this->belongsToMany(User::class);
    }

}
}
