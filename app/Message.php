<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  public $timestamps = false;
  protected $table = 'messages';
  protected $fillable = ['from_id', 'to_id', 'message', 'message_created_at']; // cambiar igual que esta en la base de datos//

    //
}
