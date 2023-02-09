@extends('includes.layout')

@section('content')
    <div class="table_container ">
        <table>
            <thead>
                <tr>
                    <th colspan='2'>
                        <p class="mssg">Apie Mane</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                </tr>
                    <th><i class="fa-solid fa-person"></i>Vardas</th>
                    <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <th><i class="fa-regular fa-envelope"></i>El. Paštas</th>
                    <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-suitcase"></i>Buto Numeris</th>
                    <td> Nr. {{ $flats->flat_nr }}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-maximize"></i>Buto kvadratūra </th>
                    <td>{{ $flats->flat_size }} m<sup>2</sup></td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-car-side"></i>Adresas</th>
                    <td>{{ $flats->belongsHouse->address }} g. {{ $flats->belongsHouse->house_nr }}, {{ $flats->belongsHouse->city }}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-face-smile-beam"></i>Buto vartotojų kiekis </th>
                    <td>{{ $flats->flatUsers->count() }}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-clock"></i>Paskutinės sąskaitos data</th>
                    <td>{{ $lastinvoiceCreated }}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-money-check-dollar"></i>Paskutinės sąskaitos suma</th>
                    <td>
                         @if (!empty($lastInvoice->sum))
                        {{ $lastInvoice->sum }} Eur
                    @else
                        Nėra duomenų
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>{!! $difference !!}</th>
                    <td >{{ $differenceAmount }}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-faucet"></i>Paskutinis vandens deklaravimas</th>
                    <td>{{ $declarationLastDate }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
