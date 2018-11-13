<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Travel;

class TravelController extends Controller
{

    public function index(){
        return view('travel');
    }
    public function storeTravel (Request $request){
        $travel = new Travel;
    
        $travelValidator = $request->validate([
            'msgInti' => 'requiered',
            'dateIn' => 'requiered',
            'dateOut' => 'requiered',
            'country' => 'requiered',
            'amount' => 'requiered',
            'coin'=>'requiered',
            'activities'=> 'requiered',
            'city' =>'requiered',
            'flexibility'=>'requiered',
    
            ]);
        }
}
