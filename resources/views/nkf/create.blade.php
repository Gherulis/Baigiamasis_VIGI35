@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Naujas NKF įrasas</h3>

        <form action="{{route('nkf.store')}}" method="POST">
        @csrf
        <div >
        <select class="form-select" name="house_id" id="" value='$house->id'>
            @foreach ($houses as $house )
            <option name="" value='{{ $house->id }}'>Namas : {{ $house->address }} g. {{ $house->house_nr }}</option>

            @endforeach

        </select>
        </div>
        <div class="login-text" style="border: none">
            <textarea type="text" name="description" placeholder='Aprašymas' value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror"></textarea>


        </div>
        <div class="login-text" style="border: none">
            <select class="form-select" name="type" id="" value=''>
                <option name="" value='Išlaidos'>Išlaidos</option>
                <option name="" value='Įplaukos'>Įplaukos</option>
                <option name="" value='Planuojamos išlaidos'>Planuojami darbai</option>



            </select>
        </div>
        <div class="login-text">
            <input type="text" name="amountPayed" value="{{ old('amountPayed') }}" placeholder="Eur su PVM"class="form-control @error('amountPayed') is-invalid @enderror">
            <label for="amountPayed">Suma</label>
            @error('amountPayed')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <input class="btn" type="submit" value="Pridėti įrašą">

        </form>
    </div>

@endsection
