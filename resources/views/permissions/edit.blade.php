@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Redaguoti teisę:</h3>

        <form action="{{route('permissions.update', $permission->id)}}" method="POST">
        @csrf
        <div class="login-text">
            <input type="text" name="name" value="{{ $permission->name }}" >
            <label for="name">Pavadinimas</label>
        </div>


        <input class="btn" type="submit" value="Redaguoti teisę">

        </form>
    </div>

@endsection
