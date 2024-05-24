<?php

namespace App\Console\Commands;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use App\Services\WeatherService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetRealWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-real {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to get weather information';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $city = $this->argument("city");
        $dbCity = CitiesModel::where(['name' => $city])->first();
        if($dbCity === null)
        {
            $dbCity = CitiesModel::create(['name' => $city]);
        }

        $weatherService = new WeatherService();
        $jsonResponse   = $weatherService->getForecast($city);

        $jsonResponse = $response->json();
        if(isset($jsonResponse['error']))
        {
            $this->output->error($jsonResponse['error']['message']);
        }

        // Ako vec postoji prognoza za danas da stane izvrsavanje komande!
        if($dbCity->todaysForecast !== null)
        {
            $this->output->comment("Command executed");
            return;
        }

        $forecastDay =  $jsonResponse["forecast"]["forecastday"][0];
        $forecastDate = $forecastDay["date"];
        $temperature = $forecastDay["day"]["avgtemp_c"];
        $weatherType = $forecastDay["day"]["condition"]["text"];
        $probability = $forecastDay["day"]["daily_chance_of_rain"];

        $forecast = [
            "city_id"  => $dbCity->id,
            "temperature" =>   $temperature,
            "forecast_date" => $forecastDate,
            "weather_type" => strtolower($weatherType),
            "probability"   => $probability,
        ];
        ForecastsModel::create($forecast);
//        ForecastsModel::create([
//            "city_id"  => $dbCity->id,
//            "temperature" =>   $temperature,
//            "forecast_date" => $forecastDate,
//            "weather_type" => strtolower($weatherType),
//            "probability"   => $probability,
//        ]);

    }
}
