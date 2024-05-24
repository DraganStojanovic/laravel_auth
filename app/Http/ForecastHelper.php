<?php

namespace App\Http;

class ForecastHelper
{
    const WEATHER_ICON = [
        'rainy' => 'fa-cloud-rain',
        'snowy' => 'fa-snowflake',
        'sunny' => 'fa-sun',
        'cloudy' => 'fa-cloud-sun'
    ];

    public static function getIconByWeatherType($type)
    {
        return match($type)
        {
            'rainy' => 'fa-cloud-rain',
            'snowy' => 'fa-snowflake',
            'sunny' => 'fa-sun',
            'cloudy' => 'fa-cloud-sun',
            default  => 'fa-sun',
        };
    }

    public static function getColorByTemperature($temperature)
    {
        if ($temperature <= 0) {
            return 'lightblue';
        } elseif ($temperature >= 1 && $temperature <= 15) {
            return 'blue';
        } elseif ($temperature > 15 && $temperature <= 25) {
            return 'green';
        } else {
            return 'red';
        }
    }
}
