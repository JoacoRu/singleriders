<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Travel;
class TravelController extends Controller
{
  public function store(Request $request)
  {
      $message = 'error al crear el viaje';
      if (Travel::create([
          'dateIn' => $request->dateIn,
          'dateOut' => $request->dateOut,
          'activities' => $request->activities,
          'country' => $request->country,
          'city' => $request->city,
          'msgIti' => $request->msgIti,
          'amount' => $request->amount,
          'coin' => $request->coin,
          'travel_creator' => Auth::id(),
      ])->users()->sync([Auth::id()])) {
            $message = 'viaje ok';
      }

      return response()->json([
          'message' => $message]);

  }

  public function destroy(Request $request)
  {
    $travel = Travel::find($request->id);

    $deltravel = Travel::where('id', $travel->id)
        ->first();
    $deltravel->delete();

    return response()->json($deltravel, 201);
  }
}
