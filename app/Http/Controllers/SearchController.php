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
        dd($request->search);
        $search = User::where('name', 'LIKE', $request->search)
        ->orWhere('lastname', 'LIKE', $request->search)
        ->get();
        return view('search', ['search' => $user]);
    }
}
