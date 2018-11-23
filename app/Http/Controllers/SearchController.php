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


    public function search($algo)
    {
        $search = User::where('name', 'LIKE', $algo)
        ->orWhere('lastname', 'LIKE', $algo)
        ->get();
        return view('search', ['search' => $user]);
    }
}
