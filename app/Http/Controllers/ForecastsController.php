<?php

namespace App\Http\Controllers;

use App\Models\CitiesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ForecastsController extends Controller
{
    public function search(Request $request)
    {

        $cityName = $request->get("city");

            Artisan::call("weather:get-real", ['city' => $cityName]);

        // Preloaded Search results with with()
        $cities = CitiesModel::with("todaysForecast")->where("name", "LIKE", "%$cityName%")->get();

        if (count($cities) == 0) {
            return redirect()->back()->with("error", "Morate biti ulogovani da bi stavili grad u favourite!");
        }

        return view("search_results", compact("cities"));
    }
}
