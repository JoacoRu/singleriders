<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function storeTravel (Request $request){
        $travel = new Travel;
    
        $travelValidator = $request->validate([
            'textmensaje' => 'requiered',
            'datein' => 'requiered',
            'dateout' => 'requiered',
            'pais' => 'requiered',
            'moneda' => 'requiered',
    
    ])
}
