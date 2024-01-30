<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;
use App\Models\ForecastsModel;

class WeatherController extends Controller
{
    public function index()
    {
//        $prognoza = [
//
//            "Beograd"   => 22,
//            "Novi Sad"  => 23,
//            "Nis"       => 24,
//            "Vranje"    => 25,
//        ];
//
//        return view('weather', compact('prognoza'));
        return view('admin/weather', [
            "weather" => Weather::all(),
        ]);
    }

    public function getAllWeather()
    {
        return view('admin/all-weather', [
            "weather" => Weather::all(),
        ]);
    }

    public function sendWeather(Request $request, Weather $id)
    {
        $request->validate([
            'city_id' => 'required|string|min:3|unique:weather',
            'temperature' => 'required|string|min:2',

        ]);

        Weather::create([
            'city_id' => $request->get('city_id'),
            'temperature' => $request->get('temperature'),
        ]);

        return redirect()->route('adminPrognoses');
    }

    public function delete($weather)
    {
        $singleWeather = Weather::where([
            'id' => $weather
        ])->first();

        if ($singleWeather === null) {
            die('Weather is not found in the list of products list!');
        }
        $singleWeather->delete();
        return redirect()->back();
    }

    public function singleWeather(Request $request, Weather $weather)
    {

        return view("/admin/edit-weather", compact("weather"));
    }

    public function save(Request $request, Weather $weather)
    {
        $weather->city_id = $request->get('city_id');
        $weather->temperature = $request->get('temperature');
        $weather->save();

        return redirect()->route('adminPrognoses');
    }
}
