@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Naujas Kontaktas</h3>
        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            <div class="login-text">
                <input type="text" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror">
                <label for="name">Vardas</label>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="login-text">
                <input type="text" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror">
                <label for="email">El.Paštas</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="login-text">
                <input type="number" name="phone" value="{{ old('phone') }}"
                    class="form-control @error('tel') is-invalid @enderror">
                <label for="text">Tel Numeris</label>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="login-text">
                <input type="text" name="comment" value="{{ old('comment') }}"
                    class="form-control @error('comment') is-invalid @enderror">
                <label for="comment">Komentaras</label>
                @error('comment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <input class="btn" type="submit" value="Pridėti">
        </form>
    </div>
@endsection
