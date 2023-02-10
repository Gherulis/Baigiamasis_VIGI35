@extends('includes.layout')

@section('content')
    <a href="{{ route('house.create') }}"><button type="submit" class="btn btn_edit">Prideti nauja nama</button></a>
    @foreach ($houses as $house)
        <div class="table_container  ">
            <table class="lentele">
                <thead>
                    <th colspan="2">Namo kortelė</th>
                </thead>
                <tbody>
                    <tr>
                        <td><i class="fa-solid fa-house"></i>Namo identifikacijos numeris</td>
                        <td>Nr. {{ $house->id }}</td>
                    </tr>

                    <tr>
                        <td><i class="fa-solid fa-person"></i>Adresas</td>
                        <td>{{ $house->address }} g. {{ $house->house_nr }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-list-ol"></i>Butu skaicius</td>
                        <td>{{ $house->houseFlat->count() }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-tree-city"></i>Miestas</td>
                        <td>{{ $house->city }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-maximize"></i>Bendras plotas</td>
                        <td>{{ $house->house_size }} m<sup>2</sup></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-piggy-bank"></i>Namo kaupimo fondas : </td>
                        <td>
                            {{ number_format($house->nkfSukaupta,2) }} Eur,
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-hammer"></i>Namo planuojamų darbų už: </td>
                        <td>

                            {{ $house->nkfPlanuSuma }} Eur,
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-money-bill-wave"></i>Paskutines saskaita pateikta:</td>
                        <td>
                            @if (isset($house->pricelists->last()->created_at))
                                {{ $house->pricelists->last()->created_at->format('Y-m-d') }}
                            @else
                                Nera duomenu
                            @endif
                        </td>
                    </tr>
                    <tr class="bg-thead">

                        <td class="bg-thead"><p class="mssg"><a href="{{ route('pricelist.create', ['house_id'=>$house->id]) }}"><button
                            class="btn_medium btn_edit">Pateikti Sąskaitą</button></a></p>
                        </td>

                        <td colspan='1'class="bg-thead">
                            <p class="mssg"><a href="{{ route('house.edit', $house) }}"><button
                                        class="btn_medium btn_edit">Redaguoti</button></a></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-thead"></td>
                        <td class="bg-thead bg-last">
                            <form action="{{ route('house.destroy', $house) }}" method="POST">
                            @csrf
                            <button class="btn_medium btn_delete">Istrinti</button> </form>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        @endforeach
@endsection
