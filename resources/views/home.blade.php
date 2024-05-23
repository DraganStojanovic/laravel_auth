@extends('master')
@section('title', 'Home Weather page')
@section('content')
    @php
        use App\Http\ForecastHelper;
    @endphp
    <div class="header mb-1 mt-4 p-4">
        <h3>Weather List Search</h3>
    </div>

{{--    <form class="form-horizontal" method="GET" action="{{ route('forecast.search') }}">--}}
{{--        @csrf--}}
{{--        @if (\Illuminate\Support\Facades\Session::has("error"))--}}
{{--            <h5 class="text-danger ps-5">{{ \Illuminate\Support\Facades\Session::get("error") }}</h5>--}}
{{--        @endif--}}
{{--        <div class="ps-5">--}}
{{--            <input type="text" name="city" placeholder="Unesite ime grada">--}}
{{--        </div>--}}
{{--        <div class="ps-5 m-2">--}}
{{--            <button class="btn btn-info" type="submit">Pronadji Grad</button>--}}
{{--        </div>--}}
{{--    </form>--}}
    <form class="form-horizontal" method="GET" action="{{ route('forecast.search') }}">
        @csrf
        @if (session('error'))
            <h5 class="text-danger ps-5">{{ session('error') }}</h5>
        @endif
        <div class="ps-5">
            <input type="text" name="city" placeholder="Unesite ime grada" required>
        </div>
        <div class="ps-5 m-2">
            <button class="btn btn-info" type="submit">Pronadji Grad</button>
        </div>
    </form>



    <div class="header mb-1 mt-4 p-4">
        <h3>Your Favorite Cities</h3>
    </div>
    <div class="d-flex flex-wrap pt-6 p-4 gap-3">
        @forelse($favoriteCities as $city)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $city->name }}</h5>
                    @if ($city->todaysForecast)
                        <p>
                            Weather Type:
                            <span style="color: {{ ForecastHelper::getColorByTemperature($city->todaysForecast->temperature) }}">
                                {{ $city->todaysForecast->weather_type }}
                                <i class="fa-solid {{ ForecastHelper::getIconByWeatherType($city->todaysForecast->weather_type) }}"></i>
                            </span>
                            <br>
                            Temperature:
                            <span style="color: {{ ForecastHelper::getColorByTemperature($city->todaysForecast->temperature) }}">
                                {{ $city->todaysForecast->temperature }} <i class="fa-solid fa-temperature-quarter"></i>
                            </span>
                        </p>
                        <p>
                            Last Update: {{ $city->forecasts->last()->forecast_date }}
                        </p>
                    @else
                        <p>
                            <span style="color:red">We have no data available for today!</span>
                        </p>
                    @endif
                </div>
            </div>
        @empty
            <p>You have no favorite cities yet.</p>
        @endforelse
    </div>
@endsection
