@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Redaguoti NKF įrašą</h3>

        <form action="{{route('nkf.update',$nkf)}}" method="POST">
        @csrf
        <div >
            <select class="form-select" name="house_id">
                @foreach ($houses as $house )
                  <option value='{{ $house->id }}' {{  old('house_id', $nkf->house_id) == $house->id ? 'selected' : '' }}>Namas: {{ $house->address }} g. {{ $house->house_nr }}</option>
                @endforeach
              </select>

        </div>
        <div class="login-text" style="border: none">
            <textarea type="text" name="description" placeholder='Aprašymas' class="form-control @error('description') is-invalid @enderror">{{ old('description', $nkf->description) }}</textarea>

        </div>
        <div class="login-text" style="border: none">
            <select class="form-select" name="type">
                <option value='islaidos' {{  old('type', $nkf->type) == 'islaidos' ? 'selected' : '' }}>Išlaidos</option>
                <option value='iplaukos' {{  old('type', $nkf->type) == 'iplaukos' ? 'selected' : '' }}>Įplaukos</option>
                <option value='planas' {{  old('type', $nkf->type) == 'planas' ? 'selected' : '' }}>Planuojamos išlaidos</option>
              </select>

        </div>
        <div class="login-text">
            <input type="text" name="amountPayed" value="{{  old('amountPayed', $nkf->amountPayed)}}" class="form-control @error('amountPayed') is-invalid @enderror">
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
