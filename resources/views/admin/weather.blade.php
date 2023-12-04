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

                <select name="weather_type">
                    @foreach(\App\Models\ForecastsModel::WEATHERS as $weather)
                            <option>{{ $weather }}</option>
                    @endforeach
                </select>

                <input type="text" name="temperature" placeholder="Add temperature">
                <input type="text" name="probability" placeholder="Add Probability">
                <input type="date" name="forecast_date">


                <button class="btn btn-primary btn-lg" type="submit">Record changes</button>


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
{{--        <table class="table table-success table-striped">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>No</th>--}}
{{--                <th>City</th>--}}
{{--                <th>Temperature</th>--}}
{{--                <th>Weather Type</th>--}}
{{--                <th>Probability %</th>--}}
{{--                <th>Actions</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach( $weather as $key=>$temperatura)--}}
{{--@foreach( \App\Models\CitiesModel::all() as $key=>$city)--}}
{{--                <tr>--}}
{{--                    <td>{{ ++$key }}</td>--}}
{{--                    <td>{{ $city->name }}</td>--}}
{{--                    <td>{{ $city->temperature }}</td>--}}

{{--                        <td>{{ $forecast->forecast_date }}</td>--}}
{{--                    <td>{{ $forecast->probability }}</td>--}}

{{--                    @endforeach--}}
{{--                    <td>--}}
{{--                        <a href="{{ route('obrisiPrognozu', ['weather' => $city->id]) }}" class="btn btn-danger">Delete</a>--}}
{{--                        <a href="{{ route('weather.single', ['weather' => $city->id ]) }}" class="btn btn-primary">Edit</a>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}


