@php
    use App\Http\ForecastHelper;
    use Carbon\Carbon;
@endphp

@extends('master')
@section('title', 'Cities pages')
@section('content')
    <div class="header mb-1 mt-4 p-4">
        <h3>Prognoses display</h3>
    </div>
    <div class="d-flex flex-wrap pt-6 p-4" style="gap: 10px;">
        @if($city)
            @php
                $icon = ForecastHelper::getIconByWeatherType(optional($city->todaysForecast)->weather_type);
            @endphp

            <ul class="list-group mb-4">
                <p class="mb-1"><strong>{{ $city->name }}</strong></p>
                @foreach($city->forecasts->sortByDesc('forecast_date') as $forecast)
                    @php
                        $boja = ForecastHelper::getColorByTemperature($forecast->temperature);
                        $icon = ForecastHelper::getIconByWeatherType($forecast->weather_type);
                    @endphp

                    <li class="list-group-item">{{ $forecast->forecast_date }} -
                        <span style="color:{{ $boja }};">
                            <i class="fa-solid {{ $icon }}"></i> - {{ $forecast->temperature }}
                            <i class="fa-solid fa-temperature-quarter"></i>
                        </span>
                    </li>
                @endforeach
                @if( $sunrise && $sunset)
                    <li class="list-group-item">
                        <strong>Sunrise:</strong> {{ \Carbon\Carbon::parse($sunrise)->format('H:i') }} <br>
                        <strong>Sunset:</strong> {{ \Carbon\Carbon::parse($sunset)->format('H:i') }}
                    </li>
                @endif
            </ul>
        @else
            <p>No city found.</p>
        @endif
    </div>
@endsection




