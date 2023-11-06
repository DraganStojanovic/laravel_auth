@extends('master')
@section('title', 'Home Weather page')

@section( 'content' )
{{--    <div class="container pt-5">--}}
{{--        <h1>Weather Today</h1><hr>--}}
{{--        <div class="d-flex p-2 bd-highlight mb-3">--}}
{{--        </div>--}}

{{--            @foreach( $weather as $weathers)--}}
{{--            <h1>Temperatura u {{ $weathers->city }} je {{ $weathers->temperature }}</h1>--}}

{{--            @endforeach--}}

{{--    </div>--}}
<div class="container pt-5">
    <h1>Weather List Today</h1>
    <div class="d-flex p-2 bd-highlight mb-3">
    </div>
    <table class="table table-success table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>City</th>
            <th>Temperature</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $weather as $key=>$temperatura)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $temperatura->city->name }}</td>
                <td>{{ $temperatura->temperature }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
