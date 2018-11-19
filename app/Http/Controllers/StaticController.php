<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Travel;
use App\User;

class StaticController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    //
    public function index() {
      $top3Travel = Travel::take(10)->get();
      return view('statics/home', ['top3Travel' => $top3Travel]);
    }
}
