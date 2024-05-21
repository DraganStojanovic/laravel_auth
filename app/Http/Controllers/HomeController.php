<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function prognoses()
    {
        return view('prognoses', [
            "weather" => Weather::all(),
        ]);


    }
    public function index()
    {
        $user = Auth::user();
        $favoriteCities = $user ? $user->cities : collect();

        return view('home', compact('favoriteCities'));
    }

}
