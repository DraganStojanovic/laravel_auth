@php
    use App\Http\ForecastHelper;use App\Models\CitiesModel;
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
                $icon = ForecastHelper::getIconByWeatherType(optional($city->todaysForecast)->weatherType);
            @endphp

            <ul class="list-group mb-4">
                <p class="mb-1"><strong>{{ $city->name }}</strong></p>
                @foreach($city->forecasts->sortByDesc('forecast_date') as $forecast)
                    @php
                        $boja = ForecastHelper::getColorByTemperature($forecast->temperature);
                        $icon = ForecastHelper::getIconByWeatherType($forecast->weather_type);
                    @endphp

                    <li class="list-group-item" >{{ $forecast->forecast_date }} - <span style="color:{{ $boja }};"><i
                                class="fa-solid {{ $icon }}"></i> - {{ $forecast->temperature }} <i
                                class="fa-solid fa-temperature-quarter"></i></span></li>
                @endforeach
            </ul>
        @else
            <p>No city found.</p>
        @endif
    </div>
@endsection



