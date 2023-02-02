@extends('includes.layout')

@section('content')



   <div class="table_container tabletransform1 contact_info">
        <table class="lentele">
            <thead>
                <tr>
                    <td colspan="8">Vandens deklaravimas</td>

                </tr>
                <tr>
                    <th>@sortablelink('formatedDate', 'Mėnuo')</th>
                    <th>@sortablelink('flat_id', 'Buto Nr.')</th>
                    <th>@sortablelink('kitchen_cold', 'Virtuvė šaltas')</th>
                    <th>@sortablelink('kitchen_hot', 'Virtuvė karštas')</th>
                    <th>@sortablelink('bath_cold', 'Vonia šaltas')</th>
                    <th>@sortablelink('bath_hot', 'Vonia karštas')</th>
                    <th>@sortablelink('declaredBy', 'Vartotojas')</th>
                    <th>Veiksmai</th>


                </tr>

            </thead>
            <tbody>

              @foreach ($declareWater as $declare )
                  <tr>
                    <td>{{$declare->formatedDate}}</td>
                    <td> Butas Nr.{{$declare->flat_id}}</td>
                    <td>{{$declare->kitchen_cold}} m<sup>3</sup></td>
                    <td>{{$declare->kitchen_hot}} m<sup>3</sup></td>
                    <td>{{$declare->bath_cold}} m<sup>3</sup></td>
                    <td>{{$declare->bath_hot}} m<sup>3</sup></td>
                    <td>{{$declare->declaredBy}}</td>

                    <td> <a href="{{route('declare.edit', $declare)}}"><button class="btn_small btn_edit"  type="submit" title="Redaguoti rodmenis"><i class="fa-solid fa-pen-clip"></i></button></a></td>
                  </tr>
              @endforeach
            </tbody>
        </table>
        <div class="center" >{{$declareWater->appends(\Request::except('page'))->links()}}  </div>
    </div>

@endsection
