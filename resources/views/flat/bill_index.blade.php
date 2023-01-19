@extends('includes.layout')

@section('content')
<div><small>{{ $test }}</small></div>
<div><small>{{ $test1 }}</small></div>

<div><small>{{ $userFlatBelongs }}</small></div>
    <div class="table_container tabletransform1 contact_info">
        <table class="lentele">

            <form action="#" method="POST">
                @csrf
                <thead>
                    <td colspan="2">
                        {{ $ltdate }}
                    </td>

                </thead>
                <tbody>
                <tr>
                    <th>Šaltas vanduo</th>
                    <td>{{ $coldWaterBill }}</td>
                </tr>
                <tr>
                    <th>Karštas vanduo</th>
                    <td>{{ $hotWaterBill }}</td>
                </tr>
                <tr>
                    <th>Šildymas</th>
                    <td>{{  $heatingBill }}</td>
                </tr>
                <tr>
                    <th>Šilumos mazgo priežiūra</th>
                    <td>{{ $heatingServiceMonthlyBill }}</td>
                </tr>
                <tr>
                    <th>Gyvatukas</th>
                    <td>{{ $bathHeaterBill }}</td>
                </tr>
                <tr>
                    <th>Šalto vandens abonimentas</th>
                    <td>{{ $coldWaterMonthlyBill }}</td>
                </tr>
                <tr>
                    <th>Elektra bendroms reikmėms</th>
                    <td>{{ $electricityForAllBill }}</td>
                </tr>
                <tr>
                    <th>Ūkio išlaidos</th>
                    <td>{{ $houseSpendingsBill }}</td>
                </tr>
                <tr>
                    <th>Namo kaupimo fondas</th>
                    <td>{{ $houseSavingBill }}</td>
                </tr>

            </tbody>


        </table>
        <div>
            <input class="btn" type="submit" value="Spausdinti">
        </div>



    </div>
@endsection
