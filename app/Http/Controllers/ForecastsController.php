<?php

namespace App\Http\Controllers;

use App\Models\CitiesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ForecastsController extends Controller
{
    public function search(Request $request)
    {
        $cityName = $request->get('city');

        if (empty($cityName)) {
            \Log::error('City name is missing in the request.');
            return redirect()->back()->with('error', 'City name is required.');
        }

        \Log::info('City name received in the request:', ['city' => $cityName]);

        Artisan::call('weather:get-real', ['city' => $cityName]);

        $cities = CitiesModel::with('todaysForecast')->where('name', 'LIKE', "%$cityName%")->get();

        if ($cities->isEmpty()) {
            return redirect()->back()->with('error', 'No cities found with the provided name.');
        }

        return view('search_results', compact('cities'));
    }

}
