@extends('includes.layout')

@section('content')







   <div class="table_container tabletransform1 contact_info">
        <table class="lentele">
            <thead>
                <tr>
                    <td colspan="4">
                        {{-- <form method="GET" action="{{ route('pricelist.index') }}">
                            <select class="input" id="filter" >
                                @foreach ($houses as $house )
                                <option value="{{ $house -> id }}">Saskaita namui : {{ $house -> address }}g. Nr. {{ $house -> house_nr }}  </option>
                                @endforeach
                            </select>
                            <button type="submit" class="button" id="filtras">Filter</button>
                        </form> --}}



                    </td>
                    <td colspan="5"></td>
                    <td colspan="2">Suma su PVM, Eur</td>
                </tr>

                <tr>
                    <th>@sortablelink('created_at', 'Mėnuo')</th>
                    <th>@sortablelink('saltas_vanduo', 'Šaltas vanduo')</th>
                    <th>@sortablelink('karstas_vanduo', 'Karštas vanduo')</th>
                    <th>@sortablelink('sildymas', 'Šildymas')</th>
                    <th>@sortablelink('silumos_mazg_prieziura', 'Šilumos mazgo priežiūra')</th>
                    <th>@sortablelink('gyvatukas', 'Gyvatukas')</th>
                    <th>@sortablelink('salto_vandens_abon', 'Šalto vandens abonimentas')</th>
                    <th>@sortablelink('elektra_bendra', 'Elektra bendroms reikmėms')</th>
                    <th>@sortablelink('ukio_islaid', 'Ūkio išlaidos')</th>
                    <th>@sortablelink('nkf', 'Namo kaupimo fondas')</th>
                    <th></th>


                </tr>

            </thead>
            <tbody>

              @foreach ($pricelist as $pricelist )
                  <tr>
                    <td>{{$pricelist->formatedDate}}</td>

                    <td>{{$pricelist->saltas_vanduo}} Eur</td>
                    <td>{{$pricelist->karstas_vanduo}} Eur</td>
                    <td>{{$pricelist->sildymas}} Eur</td>
                    <td>{{$pricelist->silumos_mazg_prieziura}} Eur</td>
                    <td>{{$pricelist->gyvatukas}} Eur</td>
                    <td>{{$pricelist->salto_vandens_abon}} Eur</td>
                    <td>{{$pricelist->elektra_bendra}} Eur</td>
                    <td>{{$pricelist->ukio_islaid}} Eur</td>
                    <td>{{$pricelist->nkf}} Eur</td>
                    <td>
                        @can('pricelist-show')
                        <a href="{{route('pricelist.showPrices', $pricelist)}}"><button class="btn_small btn_show"  type="submit" title="Peržiūrėti kainas"><i class="fa-regular fa-eye"></i></button></a>
                        @endcan
                        @can('pricelist-edit')
                        <a href="{{route('pricelist.edit', $pricelist)}}"><button class="btn_small btn_edit"  type="submit" title="Redaguoti sąskaita"><i class="fa-solid fa-pen-clip"></i></button></a>
                        @endcan


                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>





@endsection
