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

    public function show3(){
        return view('sharedTravel');
    }
/**
    * Store a new travel post.
    *
    * @param  Request  $request
    * @return Response
 */  
    // public function store (Request $request){
    
    //    $request->validate([
    //         'msgInti' => 'required',
    //         'dateIn' => 'required',
    //         'dateOut' => 'required',
    //         /* 'country' => 'required', */
    //         'amount' => 'required',
    //         'coin'=>'required',
    //         'activities'=> 'required',
    //         'flexibility'=>'required',
    
    //     ],[
    //         'msgInti.required' => 'Ingresa un titulo a tu viaje',
    //         'dateIn.required'=> 'Informanos cuando inicia tu viaje',
    //         'dateOut.required'=>'Informanos cuando finaliza tu viaje',
    //         /* 'country.required'=>'Que país vas a visitar?', */
    //         'amount.required'=>'Decinos cual es tu presupuesto',
    //         'coin.required' => 'No te olvides de indicar la moneda!',
    //         'activities.required'=> 'Completa que tipo de viaje estas pensando',
    //         'flexibility.required'=> 'No te olvides de indicar tu flebilidad de fechas!',
    //     ]);
    //         $travel = Travel::create([
    //             'dateIn'  => $reques->msgInti,
    //             'dateOut' => $reques->dateOut,
    //             'country' => $request->country,
    //             'actitivities' => $reques->activities,
    //             'city' => $reques->city,
    //             'msgInty' => $reques->msgInti,
    //             'amount' => $reques->amount,
    //             'coin' => $reques->coin,
    //             'userId' => Auth::id()
    //         ]);
    //         return response()->json($travel);
    //     }
    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */
   public function validator(Request $request)
   {

        // $tavel = $request->validate([
        //     'msgInti' => 'required',
        //     'dateIn' => 'required',
        //     'dateOut' => 'required',
        //     /* 'country' => 'required', */
        //     'amount' => 'required',
        //     'coin'=>'required',
        //     'activities'=> 'required',
        //     /* 'flexibility'=>'required', */
    
        // ]); 
        
        $travel = Travel::create([
            'dateIn'  => $request->dateIn,
            'dateOut' => $request->dateOut,
            'country' => 'EEUU',
            'actitivities' => $request->activities,
            'city' => 'Chicago',
            'msgInti' => $request->msgInti,
            'amount' => $request->amount,
            'coin' => $request->coin,
            'user_id' => Auth::id(),
        ]);

        dd($travel);
   }

        public function rules()
        {
            $rules =
            [
                'msgInti.required' => 'Ingresa un titulo a tu viaje',
                'dateIn.required'=> 'Informanos cuando inicia tu viaje',
                'dateOut.required'=>'Informanos cuando finaliza tu viaje',
                /* 'country.required'=>'Que país vas a visitar?', */
                'amount.required'=>'Decinos cual es tu presupuesto',
                'coin.required' => 'No te olvides de indicar la moneda!',
                'activities.required'=> 'Completa que tipo de viaje estas pensando',
                /* 'flexibility.required'=> 'No te olvides de indicar tu flebilidad de fechas!', */
            ];

            return $rules;
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
