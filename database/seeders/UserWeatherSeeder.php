<?php

namespace Database\Seeders;

use App\Models\Weather;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserWeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city = $this->command->getOutput()->ask("Add City?");

        if($city === null)
        {
            $this->command->getOutput()->error('Please Add City');
        }

        $temperature = $this->command->getOutput()->ask("Add City Temperature");
        if($temperature === null)
        {
            $this->command->getOutput()->error('Please Add City Temperature');
        }
        Weather::create([
            'city' => $city,
            'temperature' => $temperature
        ]);
        $this->command->getOutput()->info("Successfully added City $city and Temperature $temperature");
    }



}
