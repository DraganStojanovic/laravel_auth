@extends('master')
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
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $weather as $key=>$temperatura)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $temperatura->city->name }}</td>
                    <td>{{ $temperatura->temperature }}</td>
                    <td>
                        <a href="{{ route('obrisiPrognozu', ['weather' => $temperatura->id]) }}" class="btn btn-danger">Delete</a>
                        <a href="{{ route('weather.single', ['weather' => $temperatura->id ]) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

{{--@foreach ( $weather as $temperatura)--}}
{{--    <p>Trenutno je {{ $temperatura->temperature }} stepena u gradu {{ $temperatura->city->name }}</p>--}}
{{--@endforeach--}}
