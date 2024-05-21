<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCities extends Controller
{
    public  function favourite(Request $request)
    {
        $user = Auth::user();
        if ($user === null)
        {
            return redirect()->back()->with(["error" => "Morate biti ulogovani da bi ste videli prognozu!"]);
        }
    }
}
