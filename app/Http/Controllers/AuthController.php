<?php

namespace App\Http\Controllers;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'surname'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        $user = new User([
            'name'     => $request->name,
            'surname'     => $request->surname,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        return response()->json([
            'message' => 'Usuario ok!'], 201);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Deslogueo ok']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function userUpdate(Request $request)
    {
        $user = $request->user();
        if ($request->name) {
          $request->validate([
              'name'     => 'required|string'
          ]);
          $user->name = $request->name;
        }
        if ($request->surname) {
          $request->validate([
              'surname'     => 'required|string'
          ]);
          $user->surname = $request->surname;
        }
        if ($request->email) {
          $request->validate([
              'email'    => 'required|string|email|unique:users'
          ]);
          $user->email = $request->email;
        }
        if ($request->password) {
          $request->validate([
              'password'    => 'required|string|confirmed'
          ]);
          $user->password = bcrypt($request->password);
        }

        $user->save();
        return response()->json([
            'message' => $user], 201);
    }

    public function changeProfileAvatar(Request $request)
    {
        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

            $currentUser = $request->user();
            $imageName = 'Avatar'.$currentUser->id.'.'.request()->image->getClientOriginalExtension();

            request()->image->move(public_path('images'), $imageName);
            // guardar archivo
            //Image::make($avatar)->resize(300, 300)->save($save_path.$filename);
            // guardar en db
            $currentUser->profile_picture = $imageName;
            $currentUser->save();
            return response()->json(['path' => $imageName], 200);


    }
}
