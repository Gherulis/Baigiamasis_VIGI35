@extends('../layouts.app')

@section('content')
    <div class="container">
        <div>
            <div>
                <div class="login-form store-form">
                    <h3>{{ __('Registracija') }}</h3>
                    <div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="login-text">
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                    autocomplete="name" autofocus class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="name">{{ __('Vardas') }}</label>
                            </div>
                            <div class="login-text">
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    autocomplete="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="email">{{ __('Elektroninis paštas') }}</label>
                            </div>
                            <div class="login-text">
                                <input id="password" type="password" name="password" required autocomplete="new-password"
                                    class="form-control @error('password') is-invalid @enderror" ">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label for="password" >{{ __('Slaptažodis') }}</label>
                                        </div>
                                        <div class="login-text">
                                            <input id="password-confirm" type="password"
                                                name="password_confirmation" required autocomplete="new-password" class="form-control @error('password') is-invalid @enderror">
                                            <label for="password-confirm" >{{ __('Pakartokite slaptažodį') }}</label>
                                        </div>
                                        <div class="login-text">
                                            <input id="invitation" type="text" name="invitation" value="{{ old('invitation') }}" required autocomplete="invitation" autofocus class="form-control @error('invitation') is-invalid @enderror">

                                            @error('invitation')
                                                <span role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label for="invitation" >{{ __('Pakvietimas') }}</label>
                                        </div>
                                            <div >
                                                <button class="btn_reg" type="submit">
                                                    {{ __('Registruotis') }}
                                                </button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
