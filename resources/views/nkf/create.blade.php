@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Naujas NKF įrasas</h3>

        <form action="{{route('nkf.store')}}" method="POST">
        @csrf
        <div >
        <select class="form-select" name="house_id" id="" value='$house->id'>
            @foreach ($houses as $house )
            <option name="" value='{{ $house->id }}' {{ old('house_id') ==  $house->id  ? 'selected' : '' }}>Namas : {{ $house->address }} g. {{ $house->house_nr }}</option>

            @endforeach

        </select>
        </div>
        <div class="login-text" style="border: none">
            <textarea type="text" name="description" placeholder='Aprašymas' class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
        </div>
        <div class="login-text" style="border: none">
            <select class="form-select" name="type" id="" value="{{ old('type') }}">
                <option name="" value='Išlaidos' {{ old('type') == 'Išlaidos' ? 'selected' : '' }}>Išlaidos</option>
                <option name="" value='Įplaukos' {{ old('type') == 'Įplaukos' ? 'selected' : '' }}>Įplaukos</option>
                <option name="" value='Planas' {{ old('type') == 'Planas' ? 'selected' : '' }} >Planuojami darbai</option>

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
