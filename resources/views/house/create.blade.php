@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Naujas namas</h3>

        <form action="{{route('house.store')}}" method="POST">
        @csrf
        <div class="login-text">
            <input type="text" name="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror" >
            <label for="address">Adresas</label>
            @error('address')
            <span class="invalid-feedback" role="alert" >
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="login-text">
            <input type="number" name="house_nr" value="{{ old('house_nr') }}" class="form-control @error('house_nr') is-invalid @enderror">
            <label for="email">Namo numeris</label>
            @error('house_nr')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="login-text">
            <input type="text" name="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror">
            <label for="city">Miestas</label>
            @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="login-text">
            <input type="number" name="house_size" value="{{ old('house_size') }}" class="form-control @error('house_size') is-invalid @enderror">
            <label for="house_size">Namo plotas m<sup>2</sup></label>
            @error('house_size')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <input class="btn" type="submit" value="Pridėti">

        </form>
    </div>

@endsection
