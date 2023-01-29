@extends ('includes.layout')
@section('content')
    <div class="login-form store-form">
        <h3>Redaguoti butą : </h3>

        <form action="{{route('flat.update',$flat)}}" method="POST">
        @csrf


        <div class="login-text">
            <input type="text" name="flat_size" value="{{$flat->flat_nr}}"   >
            <label for="flat_nr">Buto Numeris</label>
        </div>
        <div class="login-text">
            <input type="number" name="flat_size" value="{{$flat->flat_size}}" >
            <label for="email">Buto Dydis</label>
        </div>
        <div class="login-text">
            <input type="text" name="gyv_mok_suma" value="{{$flat->gyv_mok_suma}}" >
            <label for="text">Gyvatuko Mokama Suma (%)</label>
        </div>

        <input class="btn" type="submit" value="Redaguoti">

        </form>
    </div>
@endsection
