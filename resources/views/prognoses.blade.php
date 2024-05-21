@php
    use App\Http\ForecastHelper;
    use App\Models\CitiesModel;
@endphp
@extends('master')
@section('title', 'Prognoses page')
@section('content')
    <div class="header mb-1 mt-4 p-4">
        <h3>Prognoses</h3>
    </div>
    <div class="d-flex flex-wrap pt-6 p-4" style="gap: 10px;">

        @foreach(CitiesModel::all() as $city)

            <ul class="list-group mb-4">
                <p class="mb-1"><strong>{{ $city->name }}</strong></p>
                @foreach($city->forecasts->sortByDesc('forecast_date') as $forecast)

                    @php
                        $boja = ForecastHelper::getColorByTemperature($forecast->temperature);
                        $icon = ForecastHelper::getIconByWeatherType($forecast->weather_type);
                    @endphp

                    <li class="list-group-item">
                        {{ $forecast->forecast_date }} -
                        <span style="color:{{ $boja }};">
                            <i class="fa-solid {{ $icon }}"></i> - {{ $forecast->temperature }}
                            <i class="fa-solid fa-temperature-quarter"></i>
                        </span>
                        <a class="btn btn-primary ms-3">
                            <i class="fa-regular text-white fa-heart" aria-hidden></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>
@endsection
