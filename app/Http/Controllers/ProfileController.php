<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function showView()
    {
        return view('profile');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'posteo' => 'required',
        ]);
        Post::create([
            'user_id' => Auth::id(),
            'post' => $request->posteo,
            'created_at' => Carbon::now()
        ]);

        /* return response()->json($request); */
    }

    public function post()
    {

        return[
            'posteo.required' => 'La publicacion no puede estar vacia',
            'posteo.string'   => 'La publicacion tiene que ser una cadena de texto',
        ];

    }

    public function getAllPost()
    {
        $post = Post::where('user_id', Auth::id())
                ->join( 'users', 'id', '=', 'user_id')
                ->orderBy('post_id','DESC')
                ->get();
        // return view('profile', ['posts' => $post]);
        return response()->json($post);
        
    }

}
