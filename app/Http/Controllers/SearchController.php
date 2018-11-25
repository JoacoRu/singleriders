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

}
