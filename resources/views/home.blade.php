@extends('master')
@section('title', 'Home Weather page')
@section( 'content' )
    <div class="header mb-1 mt-4 p-4">
        <h3>Weather List</h3>
    </div>
    <div class="col-auto">
        <button class="btn btn-dark shadow" id="btnSwitch">Toggle Mode</button>
    </div>
<div class="d-flex flex-wrap pt-6 p-4" style="gap: 10px;">
    @foreach( \App\Models\CitiesModel::all() as $city)
            <ul class="list-group mb-4">
                <p class="mb-1"><strong>{{ $city->name }}</strong></p>
                @foreach( $city->forecasts->sortByDesc('forecast_date') as $forecast)

                    @php
                        $boja = \App\Http\ForecastHelper::getColorByTemperature($forecast->temperature);
                        $icon = \App\Http\ForecastHelper::getIconByWeatherType($forecast->weather_type);
                    @endphp

                    <li class="list-group-item">{{ $forecast->forecast_date }} - <i class="fa-solid {{ $icon }}"></i><span style="color:{{ $boja }};"> - {{ $forecast->temperature }} <i class="fa-solid fa-temperature-quarter"></i></span></li>
                @endforeach
            </ul>
    @endforeach
</div>
@endsection
