<?php

namespace Database\Seeders;

use App\Models\Weather;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $weather = [

            "Obrenovac"   => 22,
            "Kikinda"  => 23,
            "Sabac"       => 24,
            "Loznica"    => 25,
        ];

        foreach ($weather as $city => $temperature)
            $userWeather = Weater::where(['city' => $city])->first();
            if($userWeather !== NULL)
            {
                $this->command->getOutput()->error("Weather data already exists!");
            }
            Weather::create([
                'city' => $city,
                'temperature' => $temperature
            ]);

    }
}
