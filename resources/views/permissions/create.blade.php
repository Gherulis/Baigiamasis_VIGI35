@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Naujas Teisė:</h3>

        <form action="{{route('permissions.store')}}" method="POST">
        @csrf
        <div class="login-text">
            <input type="text" name="name"  >
            <label for="name">Pavadinimas</label>
        </div>
        <input class="btn" type="submit" value="Sukurti teisę">
        </form>
    </div>

@endsection
