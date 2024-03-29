@extends('master')
@section('title', 'Cities pages')
@section('content')

    @php
        use App\Http\ForecastHelper;
        use App\Models\CitiesModel;
        use Carbon\Carbon;
    @endphp
    <div class="header mb-1 mt-4 p-4">
        <h3>Prognoses display</h3>
    </div>
    <div class="d-flex flex-wrap pt-6 p-4 gap-3">
        @foreach ($cities as $city)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $city->name }}</h5>
                    @if ($city->todaysForecast)
                        <p>
                            Weather Type:
                            <span
                                style="color: {{ ForecastHelper::getColorByTemperature($city->todaysForecast->temperature) }}">
                                {{ $city->todaysForecast->weather_type }}
                                {{-- Dodat sledeći red za prikaz ikone --}}
                                <i
                                    class="fa-solid {{ ForecastHelper::getIconByWeatherType($city->todaysForecast->weather_type) }}"></i>
                            </span>
                            <br>
                            Temperature:
                            <span
                                style="color: {{ ForecastHelper::getColorByTemperature($city->todaysForecast->temperature) }}">
                                {{ $city->todaysForecast->temperature }} <i class="fa-solid fa-temperature-quarter"></i>
                            </span>
                        </p>
                        <p>
                            Last Update: {{ $city->forecasts->last()->forecast_date }}
                        </p>
                        <a href="{{ route('forecast.permalink', ['city' => $city->name]) }}" class="btn btn-primary">More
                            Details</a>
                    @else
                        <p>
                            <span style="color:red">We have no data available for today!</span>
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
