<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Travel;
use App\User;
use App\Follower;


class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   /**
    * Follow a user.
    *
    *@return Response

    */

    public function existLike($user_id,$travel_id)
    {
        $follow = Follower::where('follower_user_id', $user_id)
                -> where('travel_id',$travel_id)
                ->count();
        return $follow;
    }

    public function follows(Request $request){
        $me = Auth::id();
        $unfollow = $this->existLike($me,$request->travel_id);

        if($unfollow != 0){
           $respuesta = 'Ya estas siguiendo a este viaje';
        }else{
            Follower::create([
                'travel_id'        => $request->travel_id,
                'user_id'          => $request->creador_viaje,
                'follower_user_id' => $me,
            ]);
            $respuesta = redirect('/sharedTravel/'. $request->travel_id);
        }

        return $respuesta;
    }

    public function showItinerary($travel_id){
        $travel = Travel::where('travel_id', $travel_id)
                    ->get();
        foreach ($travel as $t ) {
            $dateIn = $t['dateIn'];
            $dateOut = $t['dateOut'];
            break;
        }
        $date1= Carbon::parse($dateIn);
        $date2= Carbon::parse($dateOut);
        $diff = $date2->diffInDays($date1);

        
        return $diff;
        }

    public function allSharedTravel($travel_id){
        $diff = $this->showItinerary($travel_id);
        $me = Auth::id();
        $sharedTravel= Follower::where('follower_user_id', $me)
                                ->join('travels', 'followers.travel_id', 'travels.travel_id')
                                ->get();

        return view('/sharedTravel', ['sharedTravel' => $sharedTravel,'travel_id' => $travel_id, 'diff' => $diff]);

    }

    /* public function showItinerary($travel_id){
        $date1=Follower::find('dateIn');
        $date2=Follower::find('dateOut');
        $diff=$date2->diffInDays($date1);
        dd($diff);
        /* return view ('sharedTravel'['sharedTRavel' => $diff]) */ 


    }
    


  

