@extends ('includes.layout')
@section('content')
    <div class="login-form store-form">
        <h3>Redaguoti butą : Nr {{ $flat->flat_nr }}</h3>

        <form action="{{route('flat.update',$flat)}}" method="POST">
        @csrf

        <div class="login-text">
            <input type="number" name="flat_size" step="0.01" value="{{$flat->flat_size}}" >
            <label for="flat_size">Buto Dydis (m<sup>2</sup>)</label>
        </div>
        <div class="login-text">
            <input type="text" name="gyv_mok_suma" value="{{$flat->gyv_mok_suma}}" >
            <label for="gyv_mok_suma">Gyvatuko Mokama Suma (%)</label>
        </div>

        <input class="btn" type="submit" value="Redaguoti">

        </form>
    </div>
@endsection
