@extends('includes.layout')

@section('content')







   <div class="table_container tabletransform1 contact_info">
        <table class="lentele">
            <thead>
                <tr>
                    <td colspan="7">Paslauga</td>
                    <td colspan="3">Namo vnt. kaina su PVM, Eur</td>
                </tr>

                <tr>

                    <th>Šaltas vanduo</th>
                    <th>Karštas vanduo</th>
                    <th>Šildymas</th>
                    <th>Šilumos mazgo priežiūra</th>
                    <th>Gyvatukas</th>
                    <th>Šalto vandens abonimentas</th>
                    <th>Elektra bendroms reikmėms</th>
                    <th>Ūkio išlaidos</th>
                    <th>Namo kaupimo fondas</th>
                    <th></th>


                </tr>

            </thead>
            <tbody>


                  <tr>

                    <td>{{$pricelist->saltas_vanduo_price}} Eur</td>
                    <td>{{$pricelist->karstas_vanduo_price}} Eur</td>
                    <td>{{$pricelist->sildymas_price}} Eur</td>
                    <td>{{$pricelist->silumos_mazg_prieziura_price}} Eur</td>
                    <td>{{$pricelist->gyvatukas_price}} Eur</td>
                    <td>{{$pricelist->salto_vandens_abon_price}} Eur</td>
                    <td>{{$pricelist->elektra_bendra_price}} Eur</td>
                    <td>{{$pricelist->ukio_islaid_price}} Eur</td>
                    <td>{{$pricelist->nkf_price}} Eur</td>
                    <td> <a href="{{route('pricelist.edit', $pricelist)}}"><button class="btn_small btn_edit"  type="submit"><i class="fa-solid fa-pen-clip"></i></button></a></td>

                  </tr>

            </tbody>
        </table>
    </div>
@endsection
