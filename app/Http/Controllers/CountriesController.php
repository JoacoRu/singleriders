<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Province;

class CountriesController extends Controller
{
  public function obtenerAllCountries()
  {
    $paises = Country::all();
    return response()->json($paises, 200);
  }
  public function obtenerAllProvinces()
  {
    $provs = Province::all();
    return response()->json($provs, 200);
  }
}
