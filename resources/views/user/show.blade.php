@extends('includes.layout')

@section('content')
    <div class="table_container tabletransform1 contact_info">
{{ $declarationLastDate }}
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
                <tr>

                <tr>
                    <th><i class="fa-solid fa-person"></i>Vardas</th>
                    <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <th><i class="fa-regular fa-envelope"></i>Pastas</th>
                    <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr>

                    <th><i class="fa-solid fa-mobile-screen-button"></i>Buto Nr.</th>
                    <td> {{ $flats->flat_nr }}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Buto dydis </th>
                    <td>{{ $flats->flat_size }} m<sup>2</sup></td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Adresas</th>
                    <td>{{ $flats->belongsHouse->address }} g. {{ $flats->belongsHouse->house_nr }}</td>
                </tr>



                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Buto vartotoju kiekis : </th>
                    <td>{{ $flats->flatUsers->count() }}</td>
                </tr>

                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Paskutines saskaitos data:</th>
                    <td>{{ $lastinvoiceCreated }}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Paskutines saskaitos suma:</th>
                    <td>{{ $lastInvoice->sum }} Eur</td>
                </tr>
                <tr>
                    <th>{!! $difference !!}</th>
                    <td>{{ $differenceAmount }}</td>
                </tr>

                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Paskutinis Deklaravimas</th>
                    <td>???</td>
                </tr>

            </tbody>



        </table>

    </div>
@endsection
