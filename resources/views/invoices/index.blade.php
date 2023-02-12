@extends('includes.layout')

@section('content')
    <form action="{{ route('invoices.index') }}" method="GET">
        <div class="table_container filter">
            <table>
                <thead>
                    <tr>
                        <th>Bendra sąskaitų suma : {{ $totalInvoicesSum }} Eur</th>
                        <th>Bendra apmokėta suma: {{ $totalPaidSum }} Eur</th>
                        <th>{!! $difference !!}</th>
                        <th><label for="filter">Data : </label>
                            <select name="filter" id="" value="{{ request()->input('filter') }}">
                                @foreach ($filterDates->unique('data') as $filterDate)
                                    <option value="{{ $filterDate->created_at }}"
                                        {{ request()->input('filter') == $filterDate->created_at ? 'selected' : '' }}>
                                        {{ $filterDate->data }}
                                    </option>
                                @endforeach
                                <option value="*" {{ request()->input('filter') == '*' ? 'selected' : '' }}>Visos</option>
                            </select>
                        <th><button class="btn_medium btn_edit" type="submit">Filtruoti</button></th>
                    </tr>
                </thead>
            </form>
        </table>
    </div>
    <div class="table_container tabletransform1 pricelistIndexFlat">
        <table class="lentele">
            <thead>

                <tr>
                    </td>
                    <td colspan="13"></td>
                    <td colspan="2">Suma su PVM, Eur</td>
                    <td colspan="2"><a href="{{ route('invoices.editInvoices') }}"
                            class="btn_edit btn_medium">Redaguoti</a></td>
                </tr>

                <tr class="rotated">
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
                    <th>Saskaitos suma</th>
                    <th>Apmokėta suma</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($invoices as $invoice)
                    <tr>
                        <td name="flat_id">Butas {{ $invoice->flat_id }}</td>
                        <td name="data">{{ $invoice->data }}</td>
                        <td name="saltas_vanduo">{{ $invoice->saltas_vanduo }}</td>
                        <td name="karstas_vanduo">{{ $invoice->karstas_vanduo }} </td>
                        <td name="sildymas">{{ $invoice->sildymas }} </td>
                        <td name="silumos_mazg_prieziura">{{ $invoice->silumos_mazg_prieziura }}</td>
                        <td name="gyvatukas">{{ $invoice->gyvatukas }}</td>
                        <td name="salto_vandens_abon">{{ $invoice->salto_vandens_abon }}</td>
                        <td name="elektra_bendra">{{ $invoice->elektra_bendra }} </td>
                        <td name="ukio_islaid">{{ $invoice->ukio_islaid }} </td>
                        <td name="nkf">{{ $invoice->nkf }}</td>
                        <td name="kompensacija">{{ $invoice->Kompensacija }}</td>
                        <td name="skola">{{ $invoice->Skola }}</td>
                        <td name="permoka">{{ $invoice->Permoka }}</td>
                        <td name="delspinigiai">{{ $invoice->Delspinigiai }}</td>
                        <td name="sum">{{ $invoice->sum }}</td>
                        <td name="sumoketa">{{ $invoice->Sumoketa }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/invoiceEditable.js') }}"></script>
@endsection
