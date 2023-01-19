@extends('includes.layout')

@section('content')



   <div class="table_container tabletransform1 contact_info">
        <table class="lentele">
            <thead>
                <tr>
                    <td>Vandens deklaravimas</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>


            </thead>
            <tbody>
                <tr>
                    <td>Menuo</td>
                    <td>Buto Nr.</td>
                    <td>Virtuvė šaltas</td>
                    <td>Virtuvė karštas</td>
                    <td>Vonia šaltas</td>
                    <td>Vonia karštas</td>
                    <td>Vartotojas</td>
                    <td>Veiksmai</td>


                </tr>
              @foreach ($declareWater as $declareWater )
                  <tr>
                    <td>{{$declareWater->formatedDate}}</td>
                    <td> Butas Nr.{{$declareWater->flat_id}}</td>
                    <td>{{$declareWater->kitchen_cold}} m<sup>3</sup></td>
                    <td>{{$declareWater->kitchen_hot}} m<sup>3</sup></td>
                    <td>{{$declareWater->bath_cold}} m<sup>3</sup></td>
                    <td>{{$declareWater->bath_hot}} m<sup>3</sup></td>
                    <td>{{$declareWater->declaredBy}}</td>

                    <td> <a href="{{route('declare.edit', $declareWater)}}"><button class="btn_edit"  type="submit"><i class="fa-solid fa-pen-clip"></i></button></a></td>
                  </tr>
              @endforeach
            </tbody>
        </table>
    </div>

@endsection
