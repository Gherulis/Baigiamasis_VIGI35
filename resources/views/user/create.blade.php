@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Sukurti vartotoją</h3>

        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="login-text">
                <input type="text" name="name">
                <label for="name">Vardas : </label>
            </div>
            <div class="login-text">
                <input type="text" name="email">
                <label for="email">Elektroninis paštas : </label>
            </div>

            <div class="login-text">
                <input type="text" name="password">
                <label for="password">Slaptažodis : </label>
            </div>
            <div class="">

                <label for="flat_id">Gyvenamoji vieta : </label>

                <select name="flat_id" class="form-control" id="">
                    @foreach ($flats as $flat)
                        <option value="{{ $flat->id }}">{{ $flat->belongsHouse->address }} g. {{ $flat->flat_nr }} butas</option>
                    @endforeach
                </select>
            </div>
            <div class="">


                <label for="role">Rolė : </label>
                <select name="role" class="form-control" id="">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>


            </div>







            <input class="btn" type="submit" value="Sukurti">

        </form>
    </div>
@endsection
