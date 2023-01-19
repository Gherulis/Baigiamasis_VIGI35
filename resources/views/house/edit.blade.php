@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Redaguoti nama</h3>

        <form action="{{route('house.update',$house)}}" method="POST">
        @csrf
        <div class="login-text">
            <input type="text" name="address" value="{{ $house->address }}" class="form-control @error('address') is-invalid @enderror" >
            <label for="address">Adresas</label>
            @error('address')
            <span class="invalid-feedback" role="alert" >
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="login-text">
            <input type="number" name="house_nr" value="{{ $house->house_nr }}" class="form-control @error('house_nr') is-invalid @enderror">
            <label for="house_nr">Namo numeris</label>
            @error('house_nr')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="login-text">
            <input type="text" name="city" value="{{ $house->city }}" class="form-control @error('city') is-invalid @enderror">
            <label for="city">Miestas</label>
            @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="login-text">
            <input type="number" name="house_size" value="{{ $house->house_size }}" class="form-control @error('house_size') is-invalid @enderror">
            <label for="house_size">Namo plotas m<sup>2</sup></label>
            @error('house_size')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <input class="btn" type="submit" value="Redaguoti">

        </form>
    </div>

@endsection
