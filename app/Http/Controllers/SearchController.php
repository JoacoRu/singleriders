<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        $user = User::where('id', $id)->join('posts', 'users.id', 'posts.user_id')->join('likes', 'posts.post_id', 'likes.post_id')->get();

        dd($user);
    }

}
