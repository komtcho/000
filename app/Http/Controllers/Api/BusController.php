<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bus;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::get();
        return response()->json($buses);
    }
}
