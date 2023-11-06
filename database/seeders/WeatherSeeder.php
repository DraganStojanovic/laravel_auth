<?php

namespace Database\Seeders;

use App\Models\CitiesModel;
use App\Models\Weather;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//                $weather = [
//
//            "Obrenovac"   => 22,
//            "Kikinda"  => 23,
//            "Sabac"       => 24,
//            "Loznica"    => 25,
//        ];

        $cities = CitiesModel::all();

        foreach ($cities as $city)
        {
            $userWeather = Weather::where(['city_id' => $city->id])->first();
            if($userWeather !== NULL)
            {
                $this->command->getOutput()->error("This city already exists!");
                continue;
            }
            Weather::create([
                'city_id' => $city->id,
                'temperature' => rand(15, 30)
            ]);
        }
    }
}
