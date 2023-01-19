@extends('includes.layout')

@section('content')







   <div class="table_container tabletransform1 contact_info">
        <table class="lentele">
            <thead>
                <tr>
                    <td colspan="9">Paslauga</td>
                    <td colspan="2">Suma su PVM, Eur</td>
                </tr>


            </thead>
            <tbody>
                <tr>
                    <td>Menuo</td>
                    <td>Šaltas vanduo</td>
                    <td>Karštas vanduo</td>
                    <td>Šildymas</td>
                    <td>Šilumos mazgo priežiūra</td>
                    <td>Gyvatukas</td>
                    <td>Šalto vandens abonimentas</td>
                    <td>Elektra bendroms reikmėms</td>
                    <td>Ūkio išlaidos</td>
                    <td>Namo kaupimo fondas</td>
                    <td></td>


                </tr>
              @foreach ($pricelist as $pricelist )
                  <tr>
                    <td>{{$pricelist->formatedDate}}</td>
                    {{--<td>{{ \Carbon\Carbon::parse($pricelist->created_at)->format('Y-F')}}--}}
                    <td>{{$pricelist->saltas_vanduo}} Eur</td>
                    <td>{{$pricelist->karstas_vanduo}} Eur</td>
                    <td>{{$pricelist->sildymas}} Eur</td>
                    <td>{{$pricelist->silumos_mazg_prieziura}} Eur</td>
                    <td>{{$pricelist->gyvatukas}} Eur</td>
                    <td>{{$pricelist->salto_vandens_abon}} Eur</td>
                    <td>{{$pricelist->elektra_bendra}} Eur</td>
                    <td>{{$pricelist->ukio_islaid}} Eur</td>
                    <td>{{$pricelist->nkf}} Eur</td>
                    <td> <a href="{{route('pricelist.edit', $pricelist)}}"><button class="btn_edit"  type="submit"><i class="fa-solid fa-pen-clip"></i></button></a></td>
                  </tr>
              @endforeach
            </tbody>
        </table>
    </div>
@endsection
