@extends ('includes.layout')
@section('content')
    <div class="login-form store-form">

        <h3>Redaguoti sąskaitą : </h3>

        <form action="{{ route('pricelist.update', $pricelist) }}" method="post">
            @csrf



            <div class="login-text">
                <input type="number" name="saltas_vanduo" step="0.01" value="{{ $pricelist->saltas_vanduo }}" class="form-control @error('saltas_vanduo') is-invalid @enderror">
                <label for="name">Šaltas vanduo</label>
                @error('saltas_vanduo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="login-text">
                <input type="number" name="karstas_vanduo" step="0.01" value="{{ $pricelist->karstas_vanduo }}" class="form-control @error('saltas_vanduo') is-invalid @enderror">
                <label for="email">Karštas vanduo</label>
                @error('karstas_vanduo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="login-text">
                <input type="number" name="sildymas" step="0.01" value="{{ $pricelist->sildymas }}" class="form-control @error('saltas_vanduo') is-invalid @enderror">
                <label for="text">Šildymas</label>
                @error('sildymas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="login-text">
                <input type="number" name="silumos_mazg_prieziura" step="0.01" value="{{ $pricelist->silumos_mazg_prieziura }}" class="form-control @error('saltas_vanduo') is-invalid @enderror">
                <label for="text">Šilumos mazgo priežiūra</label>
                @error('silumos_mazg_prieziura')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="login-text">
                <input type="number" name="gyvatukas" step="0.01" value="{{ $pricelist->gyvatukas }}" class="form-control @error('saltas_vanduo') is-invalid @enderror">
                <label for="text">Gyvatukas</label>
                @error('gyvatukas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="login-text">
                <input type="number" name="salto_vandens_abon" step="0.01" value="{{ $pricelist->salto_vandens_abon }}" class="form-control @error('saltas_vanduo') is-invalid @enderror">
                <label for="text">Šalto vandens abonimentas</label>
                @error('salto_vandens_abon')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="login-text">
                <input type="number" name="elektra_bendra" step="0.01" value="{{ $pricelist->elektra_bendra }}" class="form-control @error('saltas_vanduo') is-invalid @enderror">
                <label for="text">Elektra bendroms reikmėms</label>
                @error('elektra_bendra')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="login-text">
                <input type="number" name="ukio_islaid" step="0.01" value="{{ $pricelist->ukio_islaid }}" class="form-control @error('saltas_vanduo') is-invalid @enderror">
                <label for="text">Ūkio išlaidos</label>
                @error('ukio_islaid')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="login-text">
                <input type="number" name="nkf" step="0.01" value="{{ $pricelist->nkf }}" class="form-control @error('saltas_vanduo') is-invalid @enderror">
                <label for="text">Namo kaupimo fondas</label>
                @error('nkf')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="center">
            <a href="{{ route('pricelist.edit', $pricelist) }}"><button class="btn_medium btn_edit" type="submit"><i
                        class="fa-solid fa-pen-clip"></i>Redaguoti</button></a>

        </form>
    </div>
    </div>
@endsection
