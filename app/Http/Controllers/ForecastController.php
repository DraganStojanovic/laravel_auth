<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index($city)
    {
        $forecast = [
            'Beograd' => [23, 24, 25, 18, 11],
            'Sarajevo' => [20, 22, 21, 25, 13],
        ];

        if(!array_key_exists($city, $forecast)) // Provera da li postoji grad!
        {
            die("Ovaj grad ne postoji!");
        };
    }
}
