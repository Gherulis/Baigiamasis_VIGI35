@extends ('includes.layout')
@section('content')
    <div class="login-form store-form">
        <h3>Redaguoti vartotoją</h3>

        <form action="{{route('user.update',$user)}}" method="POST">
        @csrf


        <div class="login-text">
            <input type="text" name="name" value="{{$user->name}}" >
            <label for="name">Vardas</label>
        </div>
        <div class="login-text">
            <input type="email" name="email" value="{{$user->email}}" >
            <label for="email">Elektroninis paštas</label>
        </div>
        <div class="login-text">
            <input type="phone" name="phone" value="{{$user->phone}}" placeholder="Nenurodytas">
            <label for="phone">Telefono numeris</label>
        </div>
        <label for="color">Spalvų tema: </label>
            <select name="color" id="">
                <option value="Standartinė" {{  old('color', $user->color) == 'Standartinė' ? 'selected' : '' }}>Standartinė</option>
                <option value="Pilka" {{  old('color', $user->color) == 'Pilka' ? 'selected' : '' }}>Pilka</option>
                <option value="Tamsi" {{  old('color', $user->color) == 'Tamsi' ? 'selected' : '' }}>Tamsi</option>
            </select>

        <input class="btn" type="submit" value="Redaguoti">

        </form>
    </div>
@endsection
