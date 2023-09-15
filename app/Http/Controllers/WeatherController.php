<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;

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
        return view('weather', [
            "weather" => Weather::all(),
        ]);
    }

    public function getAllWeather()
    {
        return view('all-weather', [
            "weather" => Weather::all(),
        ]);
    }

    public function sendWeather(Request $request, Weather $id)
    {
        $request->validate([
            'city' => 'required|string|min:3|unique:weather',
            'temperature' => 'required|string|min:2',

        ]);

        Weather::create([
            'city' => $request->get('city'),
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

//        $weather = Weather::where('id', $id)->first();
//        if($weather === NULL)
//        {
//            die('Product is not found');
//        }
        return view("edit-weather",compact("weather"));
    }

    public function save(Request $request, Weather $weather)
    {
//        $weather = Weather::where(['id' => $id])->first();
//
//        if($weather === NULL)
//        {
//            die('Weather is not found');
//        }
        $weather->city = $request->get('city');
        $weather->temperature = $request->get('temperature');
        $weather->save();

        return redirect()->route('adminPrognoses');

    }
}
