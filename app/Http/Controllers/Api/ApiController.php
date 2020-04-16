<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * list states
     */

     public function states()
     {
         $states = State::all();
         return response()->json($states);
     }
}
