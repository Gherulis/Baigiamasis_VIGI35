@extends('includes.layout')

@section('content')







   <div class="table_container tabletransform1 contact_info">
        <table class="lentele">
            <thead>
                <tr>
                    <td colspan="2">

                        <select name="formatedDate" id="" >
                            @foreach ($invoices->unique('data') as $listitem )
                            <option value="{{ $listitem -> data }}">{{ $listitem -> data }}</option>
                            @endforeach

                        </select>

                    </td>
                    <td colspan="12"></td>
                    <td colspan="2">Suma su PVM, Eur</td>
                </tr>

                <tr  class="rotated">
                    <th><i class="fa-solid fa-house"></i></th>
                    <th>Mėnuo</th>

                    <th>Šaltas vanduo</th>
                    <th>Karštas vanduo</th>
                    <th>Šildymas</th>
                    <th>Šilumos mazgo priežiūra</th>
                    <th>Gyvatukas</th>
                    <th>Šalto vandens abonimentas</th>
                    <th>Elektra bendroms reikmėms</th>
                    <th>Ūkio išlaidos</th>
                    <th>Namo Kaupimo fondas</th>
                    <th>Kompensacija</th>
                    <th>Skola</th>
                    <th>Permoka</th>
                    <th>Delspinigiai</th>
                    <th>Viso</th>


                </tr>

            </thead>
            <tbody>

              @foreach ($invoices as $invoice )
                  <tr>
                    <td name="flat_id">Butas {{$invoice->flat_id}}</td>
                    <td name="data">{{$invoice->data}}</td>

                    <td name="saltas_vanduo">{{$invoice->saltas_vanduo}}</td>
                    <td name="karstas_vanduo">{{$invoice->karstas_vanduo}} </td>
                    <td name="sildymas">{{$invoice->sildymas}} </td>
                    <td name="silumos_mazg_prieziura">{{$invoice->silumos_mazg_prieziura}}</td>
                    <td name="gyvatukas">{{$invoice->gyvatukas}}</td>
                    <td name="salto_vandens_abon">{{$invoice->salto_vandens_abon}}</td>
                    <td name="elektra_bendra">{{$invoice->elektra_bendra}} </td>
                    <td name="ukio_islaid">{{$invoice->ukio_islaid}} </td>
                    <td name="nkf">{{$invoice->nkf}}</td>
                    <td name="kompensacija">{{$invoice->kompensacija}}</td>
                    <td name="skola">{{$invoice->skola}}</td>
                    <td name="permoka">{{$invoice->permoka}}</td>
                    <td name="delspinigiai">{{$invoice->delspinigiai}}</td>
                    <td name="sum">{{$invoice->sum}}</td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
@endsection
