<?php

namespace App\Console\Commands;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
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
//    public function handle()
//    {
//       $url = "https://reqres.in/api/users?page=2";
//       $response = Http::get($url);
//      $jsonResponse = $response->body();
//      $jsonResponse = json_decode($jsonResponse, true); // JSON Asscpoativno array
//      dd($jsonResponse['data'][0]['email']);
//    }
    public function handle()
    {
//        die("TEST"); TEST JE PROSAO
//        $response = Http::get("https://reqres.in/api/users/2");
//        dd($response->json());

//        $response = Http::post("https://reqres.in/api/create", [
//            "name"   => "Dragan",
//            "job" => "Programmer",
//        ]);
//        dd($response->json());

//       $city = $this->argument("city");
//        $response = Http::get("api.weatherapi.com/v1/current.json", [
//            'key' => "8696aa3b9eaa4b7ea75160832242105",
//            'q' => $city,
//            'api' => "no",
//            'lang' => "sr"
//        ]);
        $city = $this->argument("city");
        $dbCity = CitiesModel::where(['name' => $city])->first();
        if($dbCity === null)
        {
            $dbCity = CitiesModel::create(['name' => $city]);
        }


        $response = Http::get(env("WEATHER_API_URL")."v1/forecast.json", [
            'key' => env("WEATHER_API_KEY"),
            'q' => $city,
            'api' => "no",
            'days' => 1,
        ]);



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
