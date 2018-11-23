<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'imgperfil' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio!',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto',
            'nombre.max' => 'El campo nombre no puede contener mas de 100 caracteres',
            'apellido.required' => 'El campo apellido es obligatorio!',
            'apellido.string' => 'El campo apellido debe ser una cadena de texto',
            'apellido.max' => 'El campo nombre no puede contener mas de 100 caracteres',
            'email.required' => 'El campo email es obligatorio!',
            'email.string' => 'El campo email debe ser una cadena de texto',
            'email.email' => 'El mail debe contener un formato valido',
            'password.required' => 'El campo password es obligatorio!',
            'password.string' => 'El campo password debe ser una cadena de texto',
            'password.min' => 'La contraseña debe tener un minimo de 6 caracteres',
            'imgperfil.required' => 'La imagen es requerida',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

      if ($data['imgperfil']) {
            //dd($data);
            $imageName = 'Avatar'.$data['email'].$data['imgperfil']->getClientOriginalExtension();

            $data['imgperfil']->move(public_path('images'), $imageName);
            // guardar archivo
            //Image::make($avatar)->resize(300, 300)->save($save_path.$filename);
            // guardar en db
            //$usuario->src = $imageName;

      }

        return User::create([
            'name' => $data['nombre'],
            'lastname' => $data['apellido'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'src' => $imageName,
        ]);

    }
}
