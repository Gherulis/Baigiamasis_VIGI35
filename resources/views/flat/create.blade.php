@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Naujas butas</h3>

        <form action="{{route('contacts.store')}}" method="POST">
        @csrf
        <div class="login-text">
            <input type="text" name="flat_nr" value="{{ old('flat_nr') }}" class="form-control @error('flat_nr') is-invalid @enderror" >
            <label for="flat_nr">Buto Nr.</label>
            @error('flat_nr')
            <span class="invalid-feedback" role="alert" >
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="login-text">
            <input type="text" name="flat_size" value="{{ old('flat_size') }}" class="form-control @error('flat_size') is-invalid @enderror">
            <label for="flat_size">Buto kvadratūra</label>
            @error('flat_size')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="login-text">
            <input type="number" name="gyv_mok_suma" value="{{ old('gyv_mok_suma') }}" class="form-control @error('gyv_mok_suma') is-invalid @enderror">
            <label for="text">Gyvatuko mokamas procentas</label>
            @error('gyv_mok_suma')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <input class="btn" type="submit" value="Pridėti">

        </form>
    </div>

@endsection
