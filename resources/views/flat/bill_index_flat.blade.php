@extends('includes.layout')

@section('content')

    <div class="table_container tabletransform1 contact_info">
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
                    <td>{{ $lastInvoice->saltas_vanduo }}</td>
                </tr>
                <tr>
                    <th>Karštas vanduo</th>
                    <td>{{ $lastInvoice->karstas_vanduo }}</td>
                </tr>
                <tr>
                    <th>Šildymas</th>
                    <td>{{  $lastInvoice->sildymas }}</td>
                </tr>
                <tr>
                    <th>Šilumos mazgo priežiūra</th>
                    <td>{{ $lastInvoice->silumos_mazg_prieziura }}</td>
                </tr>
                <tr>
                    <th>Gyvatukas</th>
                    <td>{{ $lastInvoice->gyvatukas }}</td>
                </tr>
                <tr>
                    <th>Šalto vandens abonimentas</th>
                    <td>{{ $lastInvoice->salto_vandens_abon }}</td>
                </tr>
                <tr>
                    <th>Elektra bendroms reikmėms</th>
                    <td>{{ $lastInvoice->elektra_bendra }}</td>
                </tr>
                <tr>
                    <th>Ūkio išlaidos</th>
                    <td>{{ $lastInvoice->ukio_islaid }}</td>
                </tr>
                <tr>
                    <th>Namo kaupimo fondas</th>
                    <td>{{ $lastInvoice->nkf }}</td>
                </tr>
                <tr>
                    <th>Kompensacija</th>
                    <td>{{ $lastInvoice->kompensacija }}</td>
                </tr>
                <tr>
                    <th>Skola</th>
                    <td>{{ $lastInvoice->skola }}</td>
                </tr>
                <tr>
                    <th>Permoka</th>
                    <td>{{ $lastInvoice->permoka }}</td>
                </tr>
                <tr>
                    <th>Delspinigiai</th>
                    <td>{{ $lastInvoice->delspinigiai }}</td>
                </tr>
                <tr>
                    <th> <strong>SUMA</strong> </th>
                    <td><strong>{{ $suma }}</strong></td>
                </tr>

            </tbody>


        </table>
        <div>
            <input class="btn" type="submit" value="Spausdinti">
        </div>



    </div>
@endsection
