@extends('includes.layout')

@section('content')


<a href="{{ route('house.create') }}"><button type="submit" class="btn">Prideti nauja nama</button></a>
@foreach ($house as $house )

    <div class="table_container tabletransform1 contact_info">

        <table>

            <thead>

                <tr>
                    <th colspan='1'>
                        <p class="mssg">Namo identifikacijos numeris : {{$house->id}}</p>
                    </th>
                    <th colspan='1'>
                        <form action="{{route('house.destroy',$house)}}" method="POST">
                            @csrf
                        <button class="btn btn_delete">Istrinti</button> </form>
                        <p class="mssg"><a href="{{route('house.destroy',$house)}}"><button class="btn btn_edit">Redaguoti</button></a></p>
                    </th>

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
                    <th><i class="fa-solid fa-mobile-screen-button"></i>Butu skaicius</th>
                    <td>{{$house->houseFlat->count()}}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Miestas</th>
                    <td>{{$house->city}}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Bendras plotas</th>
                    <td>{{$house->house_size}} m<sup>2</sup></td>
                </tr>

                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Namo kaupimo fondas : </th>
                    <td>
                        @if(isset($house->pricelists->last()->nkf))
                        {{$house->pricelists->last()->nkf}}
                    @else
                        Nera duomenu
                    @endif




                        </td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Paskutines saskaita pateikta:</th>
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
