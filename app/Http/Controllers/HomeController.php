<?php

namespace App\Http\Controllers;

use App\Models\Weather;

class HomeController extends Controller
{
    public function prognoses()
    {
        return view('prognoses', [
            "weather" => Weather::all(),
        ]);
    }
}
