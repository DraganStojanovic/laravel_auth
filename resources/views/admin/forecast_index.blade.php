@extends('master')
@section('title', 'Weather Administration')

@section( 'content' )

    <div  class="container pt-5">
        <h1>Admin Weather List</h1>
        <div class="d-flex p-2 bd-highlight mb-3">
        </div>
        <form method="POST" class="form-horizontal">
            @csrf
            <select name="city_id">
                @foreach(\App\Models\CitiesModel::all() as $city)
                    <option value="{{ $city->city_id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            <select name="weather_type" required>
                @foreach(\App\Models\ForecastsModel::WEATHERS as $weather)
                    <option value="{{ $weather }}">{{ $weather }}</option>
                @endforeach
            </select>

            <input type="text" name="temperature" placeholder="Add temperature">
            <input type="text" name="probability" placeholder="Add Probability">
            <input type="date" name="forecast_date" min="{{ now()->toDateString() }}">


            <button class="btn btn-primary btn-lg" type="submit">Record changes</button>


        </form>
        <div class="header mb-1 mt-4 p-4">
            <h3>Weather List</h3>
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

                        <li class="list-group-item">{{ $forecast->forecast_date }} - <span style="color:{{ $boja }};"> {{ $forecast->temperature }} <i class="fa-solid {{ $icon }}"></i><i class="fa-solid fa-temperature-quarter"></i></span></li>
                    @endforeach
                </ul>
            @endforeach
        </div>

    </div>
@stop


