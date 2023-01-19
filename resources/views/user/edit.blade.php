@extends ('includes.layout')
@section('content')
    <div class="login-form store-form">
        <h3>Redaguoti kontakta</h3>

        <form action="{{route('user.update',$user)}}" method="POST">
        @csrf


        <div class="login-text">
            <input type="text" name="name" value="{{$user->name}}" >
            <label for="name">Vardas</label>
        </div>
        <div class="login-text">
            <input type="email" name="email" value="{{$user->email}}" >
            <label for="email">Pastas</label>
        </div>


        <input class="btn" type="submit" value="Redaguoti">

        </form>
    </div>
@endsection
