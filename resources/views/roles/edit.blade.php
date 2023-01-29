@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Redaguoti Teises:</h3>

        <form action="{{route('roles.update',$role->id)}}" method="POST">
        @csrf
        <div class="login-text">
            <input type="text" name="name"  value='{{ $role->name }}'>
            <label for="name">Rolės pavadinimas : </label>
        </div>
        <div class="form-group">
            <label for="permissions">Leidimai</label>
            <br>
            @foreach ($permissions as $permission )
            <label>
                @if ($permission->roles->contains($role->id))
                <input type="checkbox" name="permissions[]" value="{{$permission->id }}" checked>
                @else
                <input type="checkbox" name="permissions[]" value="{{$permission->id }}">
                @endif
                {{ $permission->name }}

            </label>
            <br>
            @endforeach
        </div>


        <input class="btn" type="submit" value="Sukurti rolę">

        </form>
    </div>

@endsection
