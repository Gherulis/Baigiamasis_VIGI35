@extends('includes.layout')

@section('content')
@if( $errorCode === '1' )
<div id="bad_message" class="message_show alert alert-danger"><i
    class="fa-regular fa-face-frown-open alert-danger"></i> {{ ($errorMessage) }}</div>
 @else <div id="good_message" class="message_show alert alert-success"><i
        class="fa-regular fa-face-grin-wide alert-success"></i>{{ ($errorMessage) }}</div>
@endif

    <div class="table_container tabletransform1 pricelistCreate">
        <table class="lentele">
            <form action="{{ route('pricelist.store') }}" method="POST">
                @csrf
                <thead>
                    <td colspan="2">
                        Sąskaita namui: {{ $house->address }} g. {{ $house->house_nr }}
                    </td>
                </thead>
                <tbody>
                    <tr>
                        <th>Šaltas vanduo</th>
                        <td><input type="number" name="saltas_vanduo" value="{{ old('saltas_vanduo') }}" step="0.01" class="@error('saltas_vanduo') invalid @enderror">Eur su PVM</td>
                    </tr>
                    <tr>
                        <th>Karštas vanduo</th>
                        <td><input type="number" name="karstas_vanduo" value="{{ old('karstas_vanduo') }}" step="0.01" class="@error('karstas_vanduo') invalid @enderror">Eur su PVM</td>
                    </tr>
                    <tr>
                        <th>Šildymas</th>
                        <td><input type="number" name="sildymas" value="{{ old('sildymas') }}" step="0.01" class="@error('sildymas') invalid @enderror">Eur su PVM</td>
                    </tr>
                    <tr>
                        <th>Šilumos mazgo priežiūra</th>
                        <td><input type="number" name="silumos_mazg_prieziura" step="0.01" value="{{ old('silumos_mazg_prieziura') }}"class="@error('silumos_mazg_prieziura') invalid @enderror">Eur su PVM</td>
                    </tr>
                    <tr>
                        <th>Gyvatukas</th>
                        <td><input type="number" name="gyvatukas" value="{{ old('gyvatukas') }}" step="0.01" class="@error('gyvatukas') invalid @enderror">Eur su PVM</td>
                    </tr>
                    <tr>
                        <th>Šalto vandens abonimentas</th>
                        <td><input type="number" name="salto_vandens_abon" step="0.01" value="{{ old('salto_vandens_abon') }}"class="@error('salto_vandens_abon') invalid @enderror">Eur su PVM</td>
                    </tr>
                    <tr>
                        <th>Elektra bendroms reikmėms</th>
                        <td><input type="number" name="elektra_bendra" step="0.01" value="{{ old('elektra_bendra') }}"class="@error('elektra_bendra') invalid @enderror">Eur su PVM</td>
                    </tr>
                    <tr>
                        <th>Ūkio išlaidos</th>
                        <td><input type="number" name="ukio_islaid" step="0.01" value="{{ old('ukio_islaid') }}"class="@error('ukio_islaid') invalid @enderror">Eur su PVM</td>
                    </tr>
                    <tr>
                        <th>Namo kaupimo fondas</th>
                        <td><input type="number" name="nkf" step="0.01" value="{{ old('nkf') }}"class="@error('nkf') invalid @enderror">Eur su PVM</td>

                    </tr>
                </tbody>
        </table>
        <div>
            @if( $errorCode=='1')
                 @can('pricelist-create')
                <input id="error_button" class="btn btn_delete" type="" value="Sąskaitos pateikti negalima!" >
            @endcan
            @else
                @can('pricelist-create')
                <input class="btn" type="submit" value="Pateikti sąskaita">
                @endcan
            @endif


        </div>
    </div>
@endsection
