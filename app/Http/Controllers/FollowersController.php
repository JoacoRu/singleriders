<?php

namespace App\Http\Controllers;

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

    public function follows($travel_id){
    
    $me = Auth::id();
    $otherUser = User::find($id);
    $otherUser->following()->attach($travel_id);
    return redirect('/sharedTravel');   
    }

    
}
