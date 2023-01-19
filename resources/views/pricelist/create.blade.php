@extends('includes.layout')

@section('content')

    <div class="client">
        <h4>DNSB "PAPARTIS"</h4>
        <h3>Buto Nr. - {{ Auth::user()->flat_nr }}</h3>
    </div>

    <div class="table_container tabletransform1 contact_info">
        <table class="lentele">

            <form action="{{ route('pricelist.store') }}" method="POST">
                @csrf
                <thead>
                    <td colspan="2">
                        <select name="house_nr" id="" >
                            @foreach ($houses as $house )
                            <option value="{{ $house -> id }}">Saskaita namui : {{ $house -> house_nr }} Nr.</option>
                            @endforeach

                        </select>
                    </td>

                </thead>
                <tbody>
                <tr>
                    <th>Šaltas vanduo</th>
                    <td><input type="number" name="saltas_vanduo"></td>
                </tr>
                <tr>
                    <th>Karštas vanduo</th>
                    <td><input type="number" name="karstas_vanduo"></td>
                </tr>
                <tr>
                    <th>Šildymas</th>
                    <td><input type="number" name="sildymas"></td>
                </tr>
                <tr>
                    <th>Šilumos mazgo priežiūra</th>
                    <td><input type="number" name="silumos_mazg_prieziura"></td>
                </tr>
                <tr>
                    <th>Gyvatukas</th>
                    <td><input type="number" name="gyvatukas"></td>
                </tr>
                <tr>
                    <th>Šalto vandens abonimentas</th>
                    <td><input type="number" name="salto_vandens_abon"></td>
                </tr>
                <tr>
                    <th>Elektra bendroms reikmėms</th>
                    <td><input type="number" name="elektra_bendra"></td>
                </tr>
                <tr>
                    <th>Ūkio išlaidos</th>
                    <td><input type="number" name="ukio_islaid"></td>
                </tr>
                <tr>
                    <th>Namo kaupimo fondas</th>
                    <td><input type="number" name="nkf"></td>
                </tr>

            </tbody>


        </table>
        <div>
            <input class="btn" type="submit" value="Pridėti">
        </div>



    </div>
@endsection
