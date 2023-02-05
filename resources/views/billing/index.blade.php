@extends('includes.layout')

@section('content')
    <div class="client">

    </div>
    <div class="table_container">
        <table class="lentele billing_table">
            <thead>
                <tr>
                    <td>Paslauga</td>
                    <td>Suma, Eur</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Šaltas vanduo</td>
                    <td>{{ $pricelists->saltas_vanduo }}</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td>Karštas vanduo</td>
                    <td>2</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td>Šildymas</td>
                    <td>3</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td>Šilumos mazgo priežiūra</td>
                    <td>4</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td>Gyvatukas</td>
                    <td>5</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td>Šalto vandens abonimentas</td>
                    <td>6</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td>Elektra bendroms reikmėms</td>
                    <td>7</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td>Ūkio išlaidos</td>
                    <td>8</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td>Namo kaupimo fondas</td>
                    <td>9</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td>Kompensacija</td>
                    <td>10</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td>Skola</td>
                    <td>11</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td>Permoka</td>
                    <td>12</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td>Delspinigiai</td>
                    <td>13</td>
                    <td>Eur</td>
                </tr>
                <tr>
                    <td class="right"><b>IŠ VISO MOKĖTI</b></td>
                    <td>14</td>
                    <td>Eur</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
