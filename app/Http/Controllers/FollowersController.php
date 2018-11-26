<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Travel;
use App\User;
use App\Follower;


class FollowersController extends Controller
{
   /**
    * Follow a user.
    *
    *@return Response

    */

    public function existLike($user_id)
    {
        $follow = Follower::where('follower_user_id', $user_id)
                ->count();
        return $follow;
    }

    public function follows(Request $request){
        $me = Auth::id();
        $unfollow = $this->existLike($me);

        if(false){
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

    public function allSharedTravel($travel_id){
        $me = Auth::id();
        $sharedTravel= Follower::where('follower_user_id', $me)
                                ->join('travels', 'followers.travel_id', 'travels.travel_id')
                                ->get();
    
            
        return view('/sharedTravel', ['sharedTravel' => $sharedTravel]); 

    }

    /* public function showItinerary(){
        $travel=Follower::
        $date1=Find::(dateIn)
        $date2=
        $diff=$date2-$date1;
    } */
}
