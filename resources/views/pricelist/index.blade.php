@extends('includes.layout')

@section('content')
<div class="table_container filter">
    <form action="{{ route('pricelist.index') }}" method="GET">
        <table>
            <thead>
                <tr>
                    <input type="filter" name="filter" id="" value="{{ request()->filter }}" hidden>
                    <th>Viso sąskaitų už : {{ $totalInvoiceAmount }}  Eur</th>
                    <th>Viso NKF: {{ $totalNKF }} Eur</th>

                    <th><label for="dateFilter">Metai : </label>
                        <select name="dateFilter" id="" value="{{ request()->input('dateFilter') }}">
                            @foreach ($selectFilterDatas->unique('formatedDate') as $selectFilterData)

                                <option value="{{ substr($selectFilterData->created_at, 0, 4) }}"
                                    {{ request()->input('dateFilter') == substr($selectFilterData->created_at, 0, 4) ? 'selected' : '' }}>
                                   {{ $selectFilterData->formatedDate }}

                                </option>
                         @endforeach

                        </select>

                    <th><button class="btn_medium btn_edit" type="submit">Filtruoti</button></th>
                </tr>
            </thead>
        </table>
    </form>
</div>
   <div class="table_container tabletransform1 pricelistInfo">
        <table class="lentele">
            <thead>
                <tr>
                    <td>Namo sąskaitos</td>
                    <td colspan="3">
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

                @if ($pricelist->count() < 1)
                    <td colspan="11">Sąskaitų nėra</td>
                @else



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
            @endif
            </tbody>
        </table>
    </div>





@endsection
