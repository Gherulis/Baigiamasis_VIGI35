@extends('includes.layout')

@section('content')

    <div class="table_container">
        <table class="lentele">

            <form action="#" method="POST">
                @csrf
                <thead>
                    <td colspan="2">
                        {{ $lastInvoice->data }}
                    </td>

                </thead>
                <tbody>
                <tr>
                    <th>Šaltas vanduo</th>
                    <td>{{ $lastInvoice->saltas_vanduo }} Eur</td>
                </tr>
                <tr>
                    <th>Karštas vanduo</th>
                    <td>{{ $lastInvoice->karstas_vanduo }} Eur</td>
                </tr>
                <tr>
                    <th>Šildymas</th>
                    <td>{{  $lastInvoice->sildymas }} Eur</td>
                </tr>
                <tr>
                    <th>Šilumos mazgo priežiūra</th>
                    <td>{{ $lastInvoice->silumos_mazg_prieziura }} Eur</td>
                </tr>
                <tr>
                    <th>Gyvatukas</th>
                    <td>{{ $lastInvoice->gyvatukas }} Eur</td>
                </tr>
                <tr>
                    <th>Šalto vandens abonimentas</th>
                    <td>{{ $lastInvoice->salto_vandens_abon }} Eur</td>
                </tr>
                <tr>
                    <th>Elektra bendroms reikmėms</th>
                    <td>{{ $lastInvoice->elektra_bendra }} Eur</td>
                </tr>
                <tr>
                    <th>Ūkio išlaidos</th>
                    <td>{{ $lastInvoice->ukio_islaid }} Eur</td>
                </tr>
                <tr>
                    <th>Namo kaupimo fondas</th>
                    <td>{{ $lastInvoice->nkf }} Eur</td>
                </tr>
                <tr>
                    <th>Kompensacija</th>
                    <td>{{ $lastInvoice->Kompensacija }} Eur</td>
                </tr>
                <tr>
                    <th>Skola</th>
                    <td>{{ $lastInvoice->Skola }} Eur</td>
                </tr>
                <tr>
                    <th>Permoka</th>
                    <td>{{ $lastInvoice->Permoka }} Eur</td>
                </tr>
                <tr>
                    <th>Delspinigiai</th>
                    <td>{{ $lastInvoice->Delspinigiai }} Eur</td>
                </tr>
                <tr>
                    <th> <strong>SUMA</strong> </th>
                    <td><strong>{{ $suma }} Eur</strong></td>
                </tr>

            </tbody>


        </table>
        <div>
            <input class="btn" type="submit" value="Spausdinti">
        </div>



    </div>
@endsection
