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

    public function allSharedTravel($travel_id){
        $me = Auth::id();
        $sharedTravel= Follower::where('follower_user_id', $me)
                                ->join('travels', 'followers.travel_id', 'travels.travel_id')
                                ->get();

        return view('/sharedTravel', ['sharedTravel' => $sharedTravel,'travel_id' => $travel_id]);

    }

    public function showItinerary($travel_id){
        $date1=Follower::find('dateIn');
        $date2=Follower::find('dateOut');
        $diff=$date2->diffInDays($date1);
        dd($diff);
        /* return view ('sharedTravel'['sharedTRavel' => $diff]) */
    }


    /**<p><?=$date1->format('d-m-y') ?></p>
<p><?=$date2->format('d-m-y') ?></p>
<p><?=$diff->format('La resta da %d días') ?></p>

<?php for ($i=0; $i < $diff->format('%d') ; $i++) :?>
  <p>Día <?= $i ?></p>
  <p><div class="input-group">
    <span class="input-group-addon"></span>
    <input type="text" class="form-control" placeholder="Itinerario">
  </div></p>
<?php endfor;?> */
    /* public function showItinerary(){
        $travel=Follower::
        $date1=Find::(dateIn)
        $date2=
        $diff=$date2-$date1;
    } */
}
