<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Message;
use App\User;


class MessageController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function obtenerMensaje()
  {

    $mensaje = Message::where('from_id', Auth::id())
              ->orwhere('to_id', Auth::id())
              ->orderBy('message_created_at', 'desc')
              ->get();
    $usuarios = User::all();
    $userchat = '';
    return view('messages', ['mensaje' => $mensaje,'usuarios' => $usuarios, 'userchat' => $userchat]);
  }

  public function obtenerAllMessage()
  {

    $allmsg = Message::all();
    return view('mensajes', ['allmsg' => $allmsg]);
  }


  public function storeMensaje(Request $request)
  {
    Message::create([
        'from_id' => Auth::id(),
        'to_id' => $request->to_id,
        'message' => $request->mensaje,
        'message_created_at' => Carbon::now()
    ]);

    return $this->obtenerMensaje();

      //return view('messages');

  }
}
