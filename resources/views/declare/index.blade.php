@extends('includes.layout')

@section('content')



   <div class="table_container tabletransform1 contact_info">
        <table class="lentele">
            <thead>
                <tr>
                    <th colspan="8">Vandens deklaravimas</th>

                </tr>
                <tr>
                    <th>@sortablelink('created_at', 'Mėnuo')</th>
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

              @foreach ($declareWater as $declareWater )
                  <tr>
                    <td>{{$declareWater->formatedDate}}</td>
                    <td> Butas Nr.{{$declareWater->flat_id}}</td>
                    <td>{{$declareWater->kitchen_cold}} m<sup>3</sup></td>
                    <td>{{$declareWater->kitchen_hot}} m<sup>3</sup></td>
                    <td>{{$declareWater->bath_cold}} m<sup>3</sup></td>
                    <td>{{$declareWater->bath_hot}} m<sup>3</sup></td>
                    <td>{{$declareWater->declaredBy}}</td>

                    <td>
                        <a href="{{route('declare.show', $declareWater)}}"><button class="btn_small btn_show"  type="submit"><i class="fa-regular fa-eye"></i></button></a>
                        <a href="{{route('declare.edit', $declareWater)}}"><button class="btn_small btn_edit"  type="submit"><i class="fa-solid fa-pen-clip"></i></button></a>
                        <a href="{{route('declare.destroy', $declareWater)}}"><button class="btn_small btn_delete"  type="submit"><i class="fa-solid fa-trash-can"></i></button></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
        </table>
    </div>

@endsection
