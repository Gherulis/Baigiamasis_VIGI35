@extends ('includes.layout')
@section('content')
    <div class="login-form store-form">
        {{-- <div class="edit-form"> --}}
        <h3>Redaguoti kainas</h3>

        <form action="{{ route('pricelist.update', $pricelist) }}" method="post">
            @csrf

            
         
            <div class="login-text">
                <input type="number" name="saltas_vanduo" value="{{ $pricelist->saltas_vanduo }}">
                <label for="name">Šaltas vanduo</label>
            </div>
            <div class="login-text">
                <input type="number" name="karstas_vanduo" value="{{ $pricelist->karstas_vanduo }}">
                <label for="email">Karštas vanduo</label>
            </div>
            <div class="login-text">
                <input type="number" name="sildymas" value="{{ $pricelist->sildymas }}">
                <label for="text">Šildymas</label>
            </div>
            <div class="login-text">
                <input type="number" name="silumos_mazg_prieziura" value="{{ $pricelist->silumos_mazg_prieziura }}">
                <label for="text">Šilumos mazgo priežiūra</label>
            </div>
            <div class="login-text">
                <input type="number" name="gyvatukas" value="{{ $pricelist->gyvatukas }}">
                <label for="text">Gyvatukas</label>
            </div>
            <div class="login-text">
                <input type="number" name="salto_vandens_abon" value="{{ $pricelist->salto_vandens_abon }}">
                <label for="text">Šalto vandens abonimentas</label>
            </div>
            <div class="login-text">
                <input type="number" name="elektra_bendra" value="{{ $pricelist->elektra_bendra }}">
                <label for="text">Elektra bendroms reikmėms</label>
            </div>
            <div class="login-text">
                <input type="number" name="ukio_islaid" value="{{ $pricelist->ukio_islaid }}">
                <label for="text">Ūkio išlaidos</label>
            </div>
            <div class="login-text">
                <input type="number" name="nkf" value="{{ $pricelist->nkf }}">
                <label for="text">Namo kaupimo fondas</label>
            </div>
            <div>
            <a href="{{ route('pricelist.edit', $pricelist) }}"><button class="" type="submit"><i
                        class="fa-solid fa-pen-clip"></i>Redaguoti</button></a>

        </form>
    </div>
    </div>
@endsection
