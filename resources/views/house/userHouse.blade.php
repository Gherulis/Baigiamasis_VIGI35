@extends('includes.layout')

@section('content')

    <div class="table_container">
        <table>
            <thead>
                <th colspan="2">Mano namas</th>
            </thead>


            <tbody>
                </tr>
                <tr>

                <tr>
                    <th><i class="fa-solid fa-person"></i>Adresas</th>
                    <td>{{$house->address}} g. {{$house->house_nr}}</td>
                </tr>

                <tr>
                    <th><i class="fa-solid fa-list-ol"></i>Butu skaičius</th>
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
                    <th><i class="fa-solid fa-shield-cat"></i>Namo pirmininkas</th>
                    <td>{{ $house->pirmininkasName }}</td>
                </tr>
                <tr>
                    <th><i class="fa-regular fa-envelope"></i></i>Kontaktai</td>
                    <td>{{ $house->pirmininkasEmail }}</td>
                </tr>

                <tr>
                    <th><i class="fa-solid fa-piggy-bank"></i>Namo kaupimo fondas </th>
                    <td>
                        {{ number_format($house->nkfSukaupta,2) }} Eur,
                    </td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-hammer"></i>Namo planuojamų darbų už</th>
                    <td>
                        {{ $house->nkfPlanuSuma }} Eur,
                    </td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-money-bill-wave"></i>Paskutinė sąskaita pateikta</th>
                    <td>
                        @if(isset($house->pricelists->last()->created_at))
                        {{$house->pricelists->last()->created_at->format('Y-m-d')}}
                    @else
                        Nėra duomenų
                    @endif
                         </td>
                </tr>
            </tbody>






        </table>

    </div>

@endsection
