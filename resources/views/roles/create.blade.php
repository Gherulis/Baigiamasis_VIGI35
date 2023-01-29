@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Naujas Teisė:</h3>

        <form action="{{route('roles.store')}}" method="POST">
        @csrf
        <div class="login-text">
            <input type="text" name="name"  >
            <label for="name">Rolės pavadinimas : </label>
        </div>
        <div class="form-group">
            <label for="name">Leidimai</label>
            <br>
            @foreach ($permissions as $permission )
            <label for=""></label>
                <input type="checkbox" name="permissions[]" value="{{$permission->id }}">
                {{ $permission->name }}
                <br>
            </label>
            @endforeach
        </div>


        <input class="btn" type="submit" value="Sukurti rolę">

        </form>
    </div>

@endsection
