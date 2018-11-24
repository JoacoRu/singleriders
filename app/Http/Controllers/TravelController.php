<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Travel;
use App\User;

class TravelController extends Controller
{
/**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/travel';
/**
     * Show the form to create a new blog travel.
     *
     * @return Response
     */
    public function show(){
        return view('travel');
    }
    public function show2(){
        return view('myTravel');
    }

/**
    * Store a new travel post.
    *
    * @param  Request  $request
    * @return Response
 */  
    public function store (Request $request){
    
       $this->validate($request,[
            'msgInti' => 'requiered',
            'dateIn' => 'requiered',
            'dateOut' => 'requiered',
            'country' => 'requiered',
            'amount' => 'requiered',
            'coin'=>'requiered',
            'activities'=> 'requiered',
            'flexibility'=>'requiered',
    
            ]);
            Travel::create($request->all());
            return redirect('/travel');
        }
    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */
    public function messages (){
        return[
            'msgInti.required' => 'Ingresa un titulo a tu viaje',
            'dateIn.required'=> 'Informanos cuando inicia tu viaje',
            'dateOut.required'=>'Informanos cuando finaliza tu viaje',
            'country.required'=>'Que país vas a visitar?',
            'amount.required'=>'Decinos cual es tu presupuesto',
            'coin.required' => 'No te olvides de indicar la moneda!',
            'activities.required'=> 'Completa que tipo de viaje estas pensando',
            'flexibility.required'=> 'No te olvides de indicar tu flebilidad de fechas!',
        ];

        }

        public function getAllTravels (){
            $alltravels=Travel::All();
            $users=User::All();
    
            return view ('allTravel', ['alltravels'=>$alltravels,'users'=>$users]);
        }
    
        public function getMyTravels()
        {
            $myTravel = Travel::where('user_id', Auth::id())
                    ->join( 'users', 'id', '=', 'user_id')
                    ->get();
            return view('myTravel', ['myTravel' => $myTravel]);
           
        }
    








    
}
