<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\User;
use App\Like;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showView()
    {
        return view('profile');
    }

    public function store(Request $request)
    {   
        $validar = Validator::make([
            'posteo' => $request->posteo,
        ],[
            'posteo' => 'required',
        ],[
            'posteo.required' => "Escribí algo :'( ",
        ]);
        if($validar->fails()){

            $respuesta = redirect()
                         ->back()
                         ->withErrors($validar->errors());

        }else{
            $post = Post::create([
                'user_id' => Auth::id(),
                'post' => $request->posteo,
                'created_at' => Carbon::now()
            ]);
            
            $respuesta =  redirect('/profile');
        }
            return $respuesta;
    }

    public function getAllPost()
    {
        $post = Post::where('user_id', Auth::id())
                ->join( 'users', 'id', '=', 'user_id')
                ->orderBy('post_id','DESC')
                ->paginate(8);

        return view('profile', ['posts' => $post]);
    }

    public function existLike($user_id, $post_id)
    {
        $like = Like::where('user_id', $user_id)
                ->where('post_id', $post_id)
                ->count();
        return $like;
    }

    public function getAllPostJson()
    {
        $post = Like::where('user_id', Auth::id())->get();

        return response()->json($post);
    }

    public function insertLike(Request $request)
    {
        if($request->accion == 'insert'){
            $exist = $this->existLike($request->user_id, $request->post_id);
            $respuesta;
            if($exist != 0){
                $respuesta = 1;
            }else{
                $respuesta = 
                    $like = Like::create([
                        'user_id' => $request->user_id,
                        'post_id' => $request->post_id,
                    ]);
            }
        }else{
            $like = Like::where('user_id', $request->user_id)
                    ->where('post_id', $request->post_id)
                    ->delete();
        }

            return back();
    }

}
