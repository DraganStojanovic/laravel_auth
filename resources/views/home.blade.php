@extends('master')
@section('title', 'Home Weather page')
@section( 'content' )
    <div class="header mb-1 mt-4 p-4">
        <h3>Weather List Search</h3>
    </div>

    <form class="form-horizontal">
        <div class="ps-5">
            <input type="text" name="city" placeholder="Unesite ime grada">
        </div>
        <div class="ps-5 m-1">
            <button class="btn btn-info" type="submit">Pronadji Grad</button>
        </div>


    </form>
{{--<div class="d-flex flex-wrap pt-6 p-4" style="gap: 10px;">--}}
{{--    @foreach( \App\Models\CitiesModel::all() as $city)--}}
{{--            <ul class="list-group mb-4">--}}
{{--                <p class="mb-1"><strong>{{ $city->name }}</strong></p>--}}
{{--                @foreach( $city->forecasts->sortByDesc('forecast_date') as $forecast)--}}

{{--                    @php--}}
{{--                        $boja = \App\Http\ForecastHelper::getColorByTemperature($forecast->temperature);--}}
{{--                        $icon = \App\Http\ForecastHelper::getIconByWeatherType($forecast->weather_type);--}}
{{--                    @endphp--}}

{{--                    <li class="list-group-item">{{ $forecast->forecast_date }} - <i class="fa-solid {{ $icon }}"></i><span style="color:{{ $boja }};"> - {{ $forecast->temperature }} <i class="fa-solid fa-temperature-quarter"></i></span></li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--    @endforeach--}}
{{--</div>--}}
@endsection
