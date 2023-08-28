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

    public function sendWeather(Request $request)
    {
        $request->validate([
            'city' => 'required|string|min:3|unique:weather',
            'temperature' => 'required|string|min:2',

        ]);

        // php artisan storage:link -> pravi symlink na "storage/app/public"
        // Mi kada upload sliku stavljamo je u "storage/app/public/images"
        // Posle mi mozemo da pristupimo njoj pomocu symlinka iz "/public/storage/images"
        // Naravno kada ti ucitavas sliku u HTML ti ne stavljas "/public/storage/images" vec samo "/storage/images" jer "/" mu je public
        // Enjoy :)
        Weather::create([
            'city' => $request->get('city'),
            'temperature' => $request->get('temperature'),
        ]);

        return redirect('/admin/prognoza/');
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

    public function singleWeather(Request $request, $id)
    {
        $weather = Weather::where('id', $id)->first();
        if($weather === NULL)
        {
            die('Product is not found');
        }
        return view("edit-weather", compact('weather'));
    }

    public function save(Request $request, $id)
    {
        $weather = Weather::where(['id' => $id])->first();

        if($weather === NULL)
        {
            die('Weather is not found');
        }
        $weather->city = $request->get('city');
        $weather->temperature = $request->get('temperature');
        $weather->save();

//        return redirect()->back();
        return redirect('/admin/prognoza/');


    }
}
