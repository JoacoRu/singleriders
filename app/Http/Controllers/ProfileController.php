<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Like;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function showView()
    {
        return view('profile');
    }

    public function store(Request $request)
    {   
/*         $request->validate([
            'post' => 'required',
        ]); */
        if($request->ajax()){
            $post = Post::create([
                'user_id' => Auth::id(),
                'post' => $request->posteo,
                'created_at' => Carbon::now()
            ]);

            return response()->json('Mensaje creado');
        }
    }
/* 
    public function post()
    {

        return[
            'post.required' => 'La publicacion no puede estar vacia',
            'post.string'   => 'La publicacion tiene que ser una cadena de texto',
        ];

    }
 */
    public function getAllPost()
    {
        $post = Post::where('user_id', Auth::id())
                ->join( 'users', 'id', '=', 'user_id')
                ->orderBy('post_id','DESC')
                ->get();

        return view('profile', ['posts' => $post]);
    }

    public function existLike($user_id, $post_id)
    {
        $like = Like::where('user_id', $user_id)
                ->where('post_id', $post_id)
                ->count();
        return $like;
    }

    public function insertLike(Request $request)
    {
        $exist = $this->existLike($request->user_id, $request->post_id);
        $respuesta;
        if($exist != 0){
            $respuesta = 'Ya hay un like';
        }else{
            $respuesta = 
                $like = Like::create([
                    'user_id' => $request->user_id,
                    'post_id' => $request->post_id,
                ]);
        }

    }

}
