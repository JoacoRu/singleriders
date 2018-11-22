<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Travel;

class AllTravelController extends Controller
{

    public function show(){
        return view('allTravel');
    }
    public function myTravel(){
        $myTravel=Travel::where('travel_creator', Auth::id)
              ->orderBy('travel_created_at', 'desc')
              ->get();
        return view('allTravel', ['myTravel' => $myTravel]);
    }
    public function getAllTravels (){
        $alltravels=Travel::All();
        return view('allTravel',['alltravels'=>$alltravels]);
    }

    public function travelOwner(){
        $travelOwner=Travell::where('travel_creator', Auth::id)
                ->get();
        return view ('allTravel', ['travelOwner'=>$travelOwner]);
    }

}