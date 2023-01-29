@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Redaguoti Teises:</h3>


        <div class="login-text">
            <h3>{{ $role->name }}</h3>
        </div>
        <div class="form-group">
            <ul>
                @foreach ($permissions as $permission )
                <li>{{ $permission->name }}</li>

                @endforeach
            </ul>

        </div>




        </form>
    </div>

@endsection
