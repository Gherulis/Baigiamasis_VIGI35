
@extends('includes.layout')

@section('content')
<div class="table_container filter">
    <form action="{{ route('flat.index') }}" method="GET">
        <table>
            <thead>
                <tr>

                    <th>Butu skaičius name : {{ $flatCount }}</th>
                    <th>Miestas: {{ $house->city }}</th>

                    <th><label for="filter">Adresas : </label>
                        <select name="filter" id="" value="{{ request()->input('filter') }}">
                            @foreach ($filterData as $filter)
                                <option value="{{ $filter->id}}"
                                    {{ request()->input('filter') == $filter->id ? 'selected' : '' }}>
                                    {{ $filter->address }} g. {{ $filter->house_nr }}

                                </option>
                         @endforeach

                        </select>
                    <th><button class="btn_medium btn_edit" type="submit">Filtruoti</button></th>
                </tr>
            </thead>
        </table>
    </form>
</div>


   <div class="table_container tabletransform1 flatInfo">

        <table >

            <thead>

                <tr>
                    <th colspan='8'><p class="mssg">{{session('mssg')}}{{session('mssg_edit')}}</p></th>

                    <th colspan="2"><a href="{{route('flat.create', request()->input('filter','1'))}}"><button class="btn_medium btn_create" value="{{ request()->input('filter','1') }}"><i class="fa-regular fa-pen-to-square"></i>Pridėti</button></a></th>



            </tr>
                <tr>

                <th colspan="1"><i class="fa-regular fa-hashtag"></i>@sortablelink('id', 'ID')</th>
                <th colspan="3"><i class="fa-solid fa-suitcase"></i>@sortablelink('flat_nr', 'Buto Nr.')</th>
                <th colspan="3"><i class="fa-solid fa-cube"></i>@sortablelink('flat_size', 'Buto kvadratūra')</th>
                <th colspan="2"><i class="fa-solid fa-staff-snake"></i>@sortablelink('gyv_mok_suma','Gyvatuko mokamas procentas')</th>
                <th colspan="1"><i class="fa-solid fa-list-check"></i>Veiksmai</th>
                </tr>



            </thead>
            <tbody>


                    @foreach ( $flat as $butas )
                       <div>
                        <tr>
                            <td colspan="1">{{$butas->id}}</td>
                            <td colspan="3">Buto nr: {{$butas->flat_nr}} </td>
                            <td colspan="3">{{$butas->flat_size}} m<sup>2</sup></td>
                            <td colspan="2">{{$butas->gyv_mok_suma}} %</td>
                            <td colspan="1" style="margin:0 auto">
                                <div class="flex-container">
                                    <a href="{{route('flat.edit',$butas)}}">
                                        <button class="btn_small btn_edit"  type="submit" title="Redaguoti butą"><i class="fa-solid fa-pen-clip"></i></button>
                                    </a>
                                    <div>
                                    <button data-title="{{ $butas->invitation }}" type="submit" class="btn_small btn_show invitation-button" title="Buto pakvietimas" data-bs-toggle="modal" data-bs-target="#exampleModal1" value="{{ $butas->invitation }}" data-butas-invitation="{{ $butas->invitation }}">
                                        <i class="fa-solid fa-envelope-open"></i>
                                      </button></div>
                                    <form action="{{route('flat.destroy',$butas)}}" method="POST">
                                        @csrf
                                        <button data-title="{{ $butas }}" type="submit" class="btn_small btn_delete" title="Ištrinti butą" data-bs-toggle="modal" data-bs-target="#exampleModal" value="{{ $butas }}">
                                            <i class="fa-solid fa-trash-can red"></i>
                                          </button>
                                    </form>

                                </div>
                            </td>


                        </tr>

                       </div>
                    @endforeach





            </tbody>
        </table>
        <div class="center">{{$flat->appends(\Request::except('page'))->links()}} </div>
    </div>
    @extends('flat.modals')
@endsection
