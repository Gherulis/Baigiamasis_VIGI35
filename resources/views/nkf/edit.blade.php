@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Redaguoti NKF įrašą</h3>

        <form action="{{route('nkf.update',$nkf)}}" method="POST">
        @csrf
        <div >
            <select class="form-select" name="house_id">
                @foreach ($houses as $house )
                  <option value='{{ $house->id }}' {{ $nkf->house_id == $house->id ? 'selected' : '' }}>Namas: {{ $house->address }} g. {{ $house->house_nr }}</option>
                @endforeach
              </select>

        </div>
        <div class="login-text" style="border: none">
            <textarea type="text" name="description" placeholder='Aprašymas' value="{{ $nkf->description }}" class="form-control @error('description') is-invalid @enderror">{{ $nkf->description }}</textarea>


        </div>
        <div class="login-text" style="border: none">
            <select class="form-select" name="type">
                <option value='Išlaidos' {{ $nkf->type == 'Išlaidos' ? 'selected' : '' }}>Išlaidos</option>
                <option value='Įplaukos' {{ $nkf->type == 'Įplaukos' ? 'selected' : '' }}>Įplaukos</option>
                <option value='Planas' {{ $nkf->type == 'Planas' ? 'selected' : '' }}>Planuojamos išlaidos</option>
              </select>

        </div>
        <div class="login-text">
            <input type="text" name="amountPayed" value="{{ $nkf->amountPayed }}" class="form-control @error('amountPayed') is-invalid @enderror">
            <label for="amountPayed">Suma Eur,</label>
            @error('amountPayed')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <input class="btn" type="submit" value="Redaguoti">

        </form>
    </div>

@endsection
