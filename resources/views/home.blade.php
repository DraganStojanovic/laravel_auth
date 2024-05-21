@extends('master')
@section('title', 'Home Weather page')
@section( 'content' )
    <div class="header mb-1 mt-4 p-4">
        <h3>Weather List Search</h3>

    </div>

    <form class="form-horizontal" method="GET" action="{{ route('forecast.search') }}">
        @csrf
        @if (\Illuminate\Support\Facades\Session::has("error"))
            <h5 class="text-danger ps-5">{{ \Illuminate\Support\Facades\Session::get("error") }}</h5>
        @endif
        <div class="ps-5">
            <input type="text" name="city" placeholder="Unesite ime grada">
        </div>
        <div class="ps-5 m-2">
            <button class="btn btn-info" type="submit">Pronadji Grad</button>

        </div>
    </form>

@endsection
