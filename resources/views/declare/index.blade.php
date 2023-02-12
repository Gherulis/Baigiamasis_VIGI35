@extends('includes.layout')

@section('content')
<div class="table_container filter">
    <form action="{{ route('declare.index') }}" method="GET">
        <table>
            <thead>
                <tr>
                    <input type="filter" name="filter" id="" value="{{ request()->filter }}" hidden>
                    <th>Viso vandens sunaudota : {{ $totalWater }} m<sup>3</sup></th>
                    <th>Iš jų karšto : {{ $totalHotWater }} m<sup>3</sup></th>

                    <th><label for="dateFilter">Data : </label>
                        <select name="dateFilter" id="" value="{{ request()->input('dateFilter') }}">
                            @foreach ($filterDateData as $selectFilterData)

                                <option value="{{ substr($selectFilterData->created_at, 0, 7) }}"
                                    {{ request()->input('dateFilter') == substr($selectFilterData->created_at, 0, 7) ? 'selected' : '' }}>
                                   {{ $selectFilterData->formatedDate }}

                                </option>
                         @endforeach
                        </select>

                    <th><button class="btn_medium btn_edit" type="submit">Filtruoti</button></th>
                </tr>
            </thead>
        </table>
    </form>
</div>


   <div class="table_container tabletransform1 declareInfo">
        <table class="lentele">
            <thead>

                <tr>
                    <th colspan="2">Vandens deklaravimas</th>
                    <th colspan="4" class="borderLeft borderRight">Skaitiklių rodmenys</th>
                    <th colspan="2" class="borderRight">Vandens suvartota</th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <th>@sortablelink('created_at', 'Mėnuo')</th>
                    <th>@sortablelink('flat_id', 'Buto Nr.')</th>
                    <th class="borderLeft">@sortablelink('kitchen_cold', 'Virtuvė šaltas')</th>
                    <th>@sortablelink('kitchen_hot', 'Virtuvė karštas')</th>
                    <th>@sortablelink('bath_cold', 'Vonia šaltas')</th>
                    <th class="borderRight">@sortablelink('bath_hot', 'Vonia karštas')</th>
                    <th>Šalto</th>
                    <th class="borderRight">Karšto</th>
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
                    <td>{{ $declare->waterUsage }}</td>
                    <td>{{ $declare->hotWaterUsage }}</td>
                    <td>{{$declare->declaredBy}}</td>

                    <td>
                        <a href="{{route('declare.show',['declareWater'=>$declare])}}"><button class="btn_small btn_show"  type="submit" title="Peržiūrėti deklaracija"><i class="fa-regular fa-eye"></i></button></a>
                        <a href="{{route('declare.edit', $declare)}}"><button class="btn_small btn_edit"  type="submit" title="Redaguoti deklaracija"><i class="fa-solid fa-pen-clip"></i></button></a>
                        <form action="{{route('declare.destroy', $declare)}}" method="POST">
                            @csrf
                        <a href="{{route('declare.destroy', $declare)}}"><button class="btn_small btn_delete"  type="submit" title="Trinti deklaracija"><i class="fa-solid fa-trash-can"></i></button></a>
                        </form>
                    </td>
                  </tr>
              @endforeach
            </tbody>
        </table>


        <div class="center" >{{$declareWater->appends(\Request::except('page'))->links()}}  </div>
    </div>

@endsection
