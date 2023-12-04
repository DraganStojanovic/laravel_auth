@extends('master')
@section('title', 'Weather Administration')

@section( 'content' )

    <div  class="container pt-5">
        <h1>Admin Weather List</h1>
            <div class="d-flex p-2 bd-highlight mb-3">
        </div>
        <form method="POST" action="{{ route("forecasts.store") }}" class="form-horizontal">

        @csrf

            <select name="city_id" required>
                @foreach(\App\Models\CitiesModel::all() as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>

            <select name="weather_type" required>
                @foreach(\App\Models\ForecastsModel::WEATHERS as $weather)
                    <option>{{ $weather }}</option>
                @endforeach
            </select>

            <input type="text" name="temperature" placeholder="Add temperature">
            <input type="date" name="forecast_date" min="{{ now()->toDateString() }}">


            <button>Record changes</button>


        </form>

        @foreach( \App\Models\CitiesModel::all() as $city)
            <ul class="list-group">
                <br>
                <p><strong>{{ $city->name }}</strong></p>

                @foreach( $city->forecasts as $forecast)
                    <li class="list-group-item">{{ $forecast->forecast_date }} - {{ $forecast->temperature }}</li>
                @endforeach
            </ul>
        @endforeach
    </div>
@stop


