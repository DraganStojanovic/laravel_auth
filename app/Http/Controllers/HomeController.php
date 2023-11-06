<?php

namespace App\Http\Controllers;

use App\Models\Weather;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            "weather" => Weather::all(),
        ]);
    }
}
