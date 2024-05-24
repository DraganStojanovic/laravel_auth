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
//        $icon = self::WEATHER_ICON[$type] ?? null;
        //            if($type == 'rainy') {
//                return 'fa-cloud-rain';
//            }elseif($type == 'showy'){
//                return 'fa-snowflake';
//            }elseif($type == 'sunny'){
//                return 'fa-sun';
//            }
//        return $icon;

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
