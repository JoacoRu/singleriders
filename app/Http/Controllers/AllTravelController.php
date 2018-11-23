<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Travel;

class AllTravelController extends Controller
{
    public function create(){
        return view('allTravel');
    }
      
    public function getAllTravels (){
        $alltravels=Travel::All();
        return view('allTravel',['alltravels'=>$alltravels]);
    }
    public function publisher(){
        $publisher=Travel::where('travel_creator')
                ->get();
        return view ('allTravel', ['publisher'=>$publisher]);
    }
}
