<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Station;

class StationController extends Controller
{
    public function index()
    {
        $stations = Station::get();
        return response()->json($stations);
    }
}
