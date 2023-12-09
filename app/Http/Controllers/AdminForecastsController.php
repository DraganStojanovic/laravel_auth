<?php

namespace App\Http\Controllers;

use App\Models\ForecastsModel;
use App\Models\Weather;
use Illuminate\Http\Request;

class AdminForecastsController extends Controller
{
    public function store(Request $request)
    {
     //  dd($request->all());
        $request->validate([
            "city_id" => ["required", "exists:cities,id"],
            "temperature" => "required",
            "weather_type" => "required",
            "forecast_date" => "required",
        ]);

        $forecast = ForecastsModel::create([
            'city_id' => $request->input('city_id'),
            'temperature' => $request->input('temperature'),
            "weather_type" => $request->input('weather_type'),
            "forecast_date" => $request->input('forecast_date'),
        ]);

        if ($forecast) {
            return redirect()->back()->with('success', 'Forecast successfully saved!');
        } else {
            return redirect()->back()->with('error', 'Failed to save forecast to the database.');
        }
    }
}
