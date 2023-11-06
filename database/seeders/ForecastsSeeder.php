<?php

namespace Database\Seeders;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForecastsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = CitiesModel::all();

        foreach ($cities as $city)
        {
            for($i = 0; $i < 5; $i++)
            {
                ForecastsModel::create([
                    "city_id" => $city->id,
                    "temperature" => "22.22",
                    "forecast_date" => Carbon::now()
                ]);
            }
        }
    }
}
