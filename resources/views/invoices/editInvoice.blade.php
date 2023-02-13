@extends('includes.layout')

@section('content')

<form action="{{ route('invoices.editInvoices') }}" method="GET">
    <div class="table_container filter">
        <table>
            <thead>
                <tr>

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
   <div class="table_container tabletransform1 paymentInfo">
        <table class="lentele">
            <thead>
                <tr>
                    <td colspan="1">
                        Mokėjimai
                    </td>
                    <td colspan="6"></td>
                    <td colspan="1">Suma su PVM, Eur</td>

                </tr>

                <tr  class="rotated">
                    <th><i class="fa-solid fa-house"></i></th>
                    <th>Mėnuo</th>


                    <th>Kompensacija</th>
                    <th>Skola</th>
                    <th>Permoka</th>
                    <th>Delspinigiai</th>
                    <th>Viso</th>
                    <th>Apmokėta</th>


                </tr>

            </thead>
            <form action="{{ route('invoices.Update') }}" method="POST">
                @csrf
                <tbody>
                   @foreach ($invoices as $invoice )
                      <tr>
                         <td name="flat_id">Butas {{$invoice->flat_id}}</td>
                         <td name="data">{{$invoice->data}}</td>
                         <td><input name="kompensacija[]" type="number" step="0.01" value="{{ $invoice->Kompensacija }}"></td>
                         <td><input name="skola[]" type="number" step="0.01" value="{{ $invoice->Skola }}"></td>
                         <td><input name="permoka[]" type="number" step="0.01" value="{{ $invoice->Permoka }}"></td>
                         <td><input name="delspinigiai[]" type="number" step="0.01" value="{{ $invoice->Delspinigiai }}"></td>
                         <td>{{$invoice->sum}}</td>
                         <td><input name="sumoketa[]" type="number" step="0.01" value="{{ $invoice->Sumoketa }}"></td>
                         <input type="hidden" name="invoice_id[]" value="{{$invoice->id}}">
                      </tr>
                   @endforeach
                      <tr>
                        <td colspan="6" class="bg-thead"></td>
                        <td colspan="2" class="bg-thead"><button class="btn_medium bnt_edit" type="submit">Išsaugoti</button></td></tr>
                </tbody>


        </table>



    </form>
    </div>




@endsection
