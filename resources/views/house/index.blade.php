@extends('includes.layout')

@section('content')


<a href="{{ route('house.create') }}"><button type="submit" class="btn btn_edit">Prideti nauja nama</button></a>
@foreach ($house as $house )

    <div class="table_container tabletransform1 contact_info">

        <table>

            <thead>

                <tr>


                    </th>
                    <th colspan='1'>

                        <p class="mssg"><a href="{{route('house.edit',$house)}}"><button class="btn_medium btn_edit">Redaguoti</button></a></p>
                        <form action="{{route('house.destroy',$house)}}" method="POST">
                            @csrf

                    </th>
                    <th><button class="btn_medium btn_delete">Istrinti</button> </form></th>

                </tr>

            </thead>


            {{-- {{ $house}} --}}
            <tbody>
                </tr>
                <tr>

                <tr>
                    <th><i class="fa-solid fa-person"></i>Adresas</th>
                    <td>{{$house->address}} g. {{$house->house_nr}}</td>
                </tr>

                <tr>
                    <th><i class="fa-solid fa-list-ol"></i>Butu skaicius</th>
                    <td>{{$house->houseFlat->count()}}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-tree-city"></i>Miestas</th>
                    <td>{{$house->city}}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-maximize"></i>Bendras plotas</th>
                    <td>{{$house->house_size}} m<sup>2</sup></td>
                </tr>

                <tr>
                    <th><i class="fa-solid fa-piggy-bank"></i>Namo kaupimo fondas : </th>
                    <td>
                        @if(isset($house->pricelists->last()->nkf))
                        {{$house->pricelists->last()->nkf}}
                    @else
                        Nera duomenu
                    @endif




                        </td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-money-bill-wave"></i>Paskutines saskaita pateikta:</th>
                    <td>
                        @if(isset($house->pricelists->last()->created_at))
                        {{$house->pricelists->last()->created_at->format('Y-m-d')}}
                    @else
                        Nera duomenu
                    @endif
                         </td>
                </tr>
            </tbody>






        </table>

    </div>
    @endforeach
@endsection
