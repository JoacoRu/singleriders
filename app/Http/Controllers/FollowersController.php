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

    public function follows(Request $request){

    $me = Auth::id();
    $repsuesta = Follower::create([
            'travel_id'        => $request->travel_id,
            'user_id'          => $request->creador_viaje,
            'follower_user_id' => $me,
    ]);

    return redirect('/sharedTravel');
    }


}
