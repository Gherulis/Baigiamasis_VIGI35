@extends('includes.layout')

@section('content')
    <a href="{{ route('house.create') }}"><button type="submit" class="btn btn_edit"><i class="fa-solid fa-house"></i>Pridėti naują namą</button></a>
    @foreach ($houses as $house)
        <div class="table_container  ">
            <table class="lentele">
                <thead>
                    <th colspan="6"><i class="fa-solid fa-house"></i>Namo kortelė</th>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3"><i class="fa-solid fa-house"></i>Namo identifikacijos numeris</td>
                        <td colspan="3">Nr. {{ $house->id }}</td>
                    </tr>

                    <tr>
                        <td colspan="3"><i class="fa-solid fa-person"></i>Adresas</td>
                        <td colspan="3">{{ $house->address }} g. {{ $house->house_nr }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><i class="fa-solid fa-list-ol"></i>Butų skaičius</td>
                        <td colspan="3">{{ $house->houseFlat->count() }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><i class="fa-solid fa-tree-city"></i>Miestas</td>
                        <td colspan="3">{{ $house->city }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><i class="fa-solid fa-maximize"></i>Bendras plotas</td>
                        <td colspan="3">{{ $house->house_size }} m<sup>2</sup></td>
                    </tr>
                    <tr>
                        <td colspan="3"><i class="fa-solid fa-piggy-bank"></i>Namo kaupimo fondas </td>
                        <td colspan="3">
                            {{ number_format($house->nkfSukaupta,2) }} Eur,
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><i class="fa-solid fa-hammer"></i>Namo planuojamų darbų už sumą</td>
                        <td colspan="3">

                            {{ $house->nkfPlanuSuma }} Eur,
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><i class="fa-solid fa-money-bill-wave"></i>Paskutinė sąskaita pateikta</td>
                        <td colspan="3">
                            @if (isset($house->pricelists->last()->created_at))
                                {{ $house->pricelists->last()->created_at->format('Y-m-d') }}
                            @else
                                Nera duomenu
                            @endif
                        </td>
                    </tr >
                    <tr class="bg-thead">
                        <td colspan="2" class="bg-thead"><p class="mssg">
                             @can('flat-view')<a href="{{ route('flat.index', ['filter'=>$house->id]) }}"><button
                            class="btn_medium btn_edit">
                            <i class="fa-solid fa-key"></i>Namo butai</button></a></p>
                            @endcan
                        </td>

                        <td colspan='2'class="bg-thead">
                            @can('declare-view')
                            <p class="mssg"><a href="{{ route('declare.index',  ['filter'=>$house->id]) }}"><button
                                        class="btn_medium btn_edit">
                                        <i class="fa-solid fa-faucet"></i>Namo deklaracijos</button></a></p>
                            @endcan
                        </td>
                        <td colspan='2'class="bg-thead">
                            @can('user-view')
                            <p class="mssg"><a href="{{ route('user.index', ['house_id'=>$house->id]) }}"><button
                                        class="btn_medium btn_edit">
                                        <i class="fa-solid fa-person"></i>Namo gyventojai</button></a></p>
                            @endcan
                        </td>
                    </tr>
                    <tr class="bg-thead">
                        <td colspan="2" class="bg-thead bg-last">
                            @can('pricelist-view')
                            <p class="mssg"><a href="{{ route('pricelist.index', ['filter'=>$house->id]) }}"><button
                            class="btn_medium btn_edit">
                            <i class="fa-solid fa-money-check dollar"></i>Namo sąskaitos</button></a></p>
                            @endcan
                        </td>
                        <td colspan='2'class="bg-thead bg-last">
                            @can('pricelist-create')
                            <p class="mssg"><a href="{{ route('pricelist.create',['house_id'=>$house->id]) }}"><button
                                        class="btn_medium btn_edit">
                                        <i class="fa-solid fa-file-invoice-dollar"></i>Pateikti sąskaitą</button></a></p>
                            @endcan
                        </td>
                        <td colspan='2'class="bg-thead bg-last">
                            @can('nkf-view')
                            <p class="mssg"><a href="{{ route('nkf.index', ['filter'=>$house->id]) }}"><button
                                        class="btn_medium btn_edit">
                                        <i class="fa-solid fa-piggy-bank"></i>NKF</button></a></p>
                            @endcan
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="bg-thead"></td>
                        <td colspan='2'class="bg-thead bg-last" >
                            @can('house-edit')
                            <p class="mssg"><a href="{{ route('house.edit', $house) }}"><button
                                        class="btn_medium btn_edit">
                                        <i class="fa-solid fa-pencil"></i>Redaguoti</button></a></p>
                            @endcan
                        </td>
                        <td colspan="2" class="bg-thead bg-last">
                            @can('house-delete')
                            <form action="{{ route('house.destroy', $house) }}" method="POST">
                            @csrf
                            <button class="btn_medium btn_delete">
                                <i class="fa-solid fa-trash-can"></i>Ištrinti</button> </form>
                            @endcan
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        @endforeach
@endsection
