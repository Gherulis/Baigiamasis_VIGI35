<!DOCTYPE html>
<html lang="en">


<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<title>Prisijungimas</title>
<body>
    <div class="login_container">
        <div class="login-form">
            <h3>Prisijungimas</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-text">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="username">Elektroninis Paštas</label>
                </div>
                <div class="login-text ">
                    <input id="password" class="txt_center" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="password">Slaptažodis</label>
                </div>


                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Prisimink mane') }}
                    </label>
                </div>
                <div class="flex-container login_spc center">
                <a href="register" class="small-grey">Registruotis</a>
                <a href="password/reset" class="small-grey">Pamiršau slaptažodį</a>
            </div>
                <input class="btn" type="submit" value="Prisijungti">
            </form>
        </div>
    </div>

</body>

</html>
