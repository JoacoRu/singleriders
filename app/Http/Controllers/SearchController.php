<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Like;


class SearchController extends Controller
{
    public function viewSearch()
    {
        return view('search');
    }
    
    public function search(Request $request)
    {
        $searchs = User::where('name', 'like','%' . $request->search .'%' )
                    ->orWhere('lastname', 'like', '%' . $request->search .'%')
                    ->get();
        return view('/search', ['searchs' => $searchs]);

    }

    public function bringUser($id)
    {
        $user = User::where('id', $id)
                    ->get();

        return $user;
    }

    public function bringPosts($id)
    {
        $posts = Post::where('user_id', $id)->get();

        return $posts;
    }

    public function countPost($id)
    {
        $posts = Post::where('user_id', $id)->count();

        return $posts;
    }

    public function bringAll($id)
    {
        $user   = $this->bringUser($id);
        $count  = $this->countPost($id);

        if($count != 0)
        {
            $respuesta = $posts = $this->bringPosts($id);

        }else{
            $respuesta = 'No hay post papa';
        }       

        return view('/searchResult', compact(['user','respuesta']));
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
            $respuesta = 1;
        }else{
            $respuesta = 
                $like = Like::create([
                    'user_id' => $request->user_id,
                    'post_id' => $request->post_id,
                ]);
        }
            return back();
    }

}
