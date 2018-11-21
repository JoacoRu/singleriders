<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  protected function validator(Request $data)
  {
      $data->validate([
          'nombre' => 'required|string|max:100',
          'apellido' => 'required|string|max:100',
      ], [
          'nombre.required' => 'El campo nombre es obligatorio!',
          'nombre.string' => 'El campo nombre debe ser una cadena de texto',
          'nombre.max' => 'El campo nombre no puede contener mas de 100 caracteres',
          'apellido.required' => 'El campo apellido es obligatorio!',
          'apellido.string' => 'El campo apellido debe ser una cadena de texto',
          'apellido.max' => 'El campo nombre no puede contener mas de 100 caracteres'
      ]);

      $usuario = User::find(Auth::id());
      $usuario->name = $data['nombre'];
      // agregar surname a la tabla $usuario->surname = $data['apellido'];
      if ($data['email'] != Auth::user()->email) {
        $data->validate([
            'email' => 'required|string|email|max:255|unique:users',
        ], [
            'email.required' => 'El campo email es obligatorio!',
            'email.string' => 'El campo email debe ser una cadena de texto',
            'email.email' => 'El mail debe contener un formato valido'
        ]);
        $usuario->email = $data['email'];
      }
      if (trim($data['password']) != '') {
        $data->validate([
            'password' => 'string|min:6',
        ], [
            'password.required' => 'El campo password es obligatorio!',
            'password.string' => 'El campo password debe ser una cadena de texto',
            'password.min' => 'La contraseña debe tener un minimo de 6 caracteres',
        ]);
        $usuario->password = Hash::make($data['password']);
      }
      //agregar imagen de perfil
      $usuario->save();

      //return view('edit_profile');
      return back();


  }


  public function show()
  {
    return view('edit_profile');
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
