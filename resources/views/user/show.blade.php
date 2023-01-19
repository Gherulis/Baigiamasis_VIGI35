
@extends('includes.layout')

@section('content')



    <div class="table_container tabletransform1 contact_info">

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
                    <td>{{ $flats->flat_size }}</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Adresas</th>
                    <td>{{ $flats->belongsHouse->address }} g. {{ $flats->belongsHouse->house_nr }}</td>
                </tr>



                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Buto vartotoju kiekis : </th>
                    <td>{{ $flats->flatUsers->count()}}</td>
                </tr>

                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Paskutines saskaitos data:</th>
                    <td>???</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Paskutines saskaitos suma:</th>
                    <td>???</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Skola:</th>
                    <td>???</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Permoka:</th>
                    <td>???</td>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-exclamation"></i>Paskutinis Deklaravimas</th>
                    <td>???</td>
                </tr>

            </tbody>



        </table>

    </div>

    @endsection

