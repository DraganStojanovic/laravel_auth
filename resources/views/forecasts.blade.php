@extends('admin.layout')
@section('title', 'Weather Administration')

@section( 'content' )

    <div class="container pt-5">
        <h1>Admin Weather List</h1>
        <div class="d-flex p-2 bd-highlight mb-3">
        </div>
        <table class="table table-success table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>City</th>
                <th>Temperature</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $city->forecasts as $key=>$prognoza)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $prognoza->city->name }}</td>
                    <td>{{ $prognoza->temperature }}</td>
                    <td>{{ $prognoza->forecast_date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
