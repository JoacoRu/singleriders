<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Travel;

class MyTravelController extends Controller
{
    public function show2(){
        return view('myTravel');
    }

    /* public function myTravel(){
        $myTravel=Travel::find('travel_creator')  
                ->get();
        return view('myTravel', ['myTravel' => $myTravel]);
    } */
}
