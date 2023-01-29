@extends ('includes.layout')
@section('content')
    <div class="login-form store-form">
        <h3>Redaguoti rodmenis :</h3>

        <form action="{{route('declare.update',$declareWater)}}" method="POST">
        @csrf


        <div class="login-text">
            <input type="text" name="kitchen_cold" value="{{$declareWater->kitchen_cold}}"   >
            <label for="kitchen_cold">Virtuvė šaltas vanduo</label>
        </div>
        <div class="login-text">
            <input type="text" name="kitchen_hot" value="{{$declareWater->kitchen_hot}}"   >
            <label for="kitchen_hot">Virtuvė karštas vanduo</label>
        </div>
        <div class="login-text">
            <input type="text" name="bath_cold" value="{{$declareWater->bath_cold}}"   >
            <label for="bath_cold">Vonia šaltas vanduo</label>
        </div>
        <div class="login-text">
            <input type="text" name="bath_hot" value="{{$declareWater->bath_hot}}"   >
            <label for="bath_hot">Vonia karštas vanduo</label>
        </div>

        <input class="btn" type="submit" value="Redaguoti">

        </form>
    </div>
@endsection
