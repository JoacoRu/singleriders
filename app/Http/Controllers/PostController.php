<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;
class PostController extends Controller
{

    public function obtenerPost()
    {

      $posteo = Post::where('user_id', Auth::id())
                ->get();
      return response()->json($posteo, 201);
    }

    public function obtenerAllPost()
    {

      $posteo = Post::all();
      return response()->json($posteo, 201);
    }


    public function store(Request $request)
    {
        $message = 'error al crear el post';
        if (Post::create([
            'user_id' => Auth::id(),
            'texto_posteo' => $request->texto_posteo
        ])) {
              $message = 'post ok';
        }

        return response()->json([
            'message' => $message]);

    }

    public function destroy(Request $request)
    {
        $post = Post::find($request->id);

        $delpost = Post::where('user_id', Auth::id())
            ->where('id', $post->id)
            ->first();
        $delpost->delete();
        return response()->json($delpost, 201);
    }
}
