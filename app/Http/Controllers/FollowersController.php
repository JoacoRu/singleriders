<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Travel;
use App\User;

class FollowersController extends Controller
{
   /**
    * Follow a user.
    *
    *@return Response

    */

    public function follows(Request $request){

    $me = Auth::id();
    $otherUser = User::find($request->creador_viaje);
    $otherUser->Following()->attach($request->travel_id);
    return redirect('/sharedTravel');
    }


}
