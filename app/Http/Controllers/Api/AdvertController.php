<?php

namespace App\Http\Controllers\Api;

use App\Advert;
use App\Http\Controllers\Controller;

class AdvertController extends Controller
{
    public function index()
    {
        $adverts = Advert::all();
        return response()->json($adverts);
    }
}
