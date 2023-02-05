@extends ('includes.layout')
@section('content')
    <div class="login-form store-form">
        <h3>Redaguoti kontakta</h3>

        <form action="{{ route('contact.update', $contacts) }}" method="POST">
            @csrf
            <div class="login-text">
                <input type="text" name="name" value="{{ $contacts->vardas }}">
                <label for="name">Vardas</label>
            </div>
            <div class="login-text">
                <input type="email" name="email" value="{{ $contacts->pastas }}">
                <label for="email">Pastas</label>
            </div>
            <div class="login-text">
                <input type="text" name="phone" value="{{ $contacts->tel }}">
                <label for="text">Tel.Nr</label>
            </div>
            <input class="btn" type="submit" value="Redaguoti">
        </form>
    </div>
@endsection
