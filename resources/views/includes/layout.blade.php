<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">



    <title>Pagrindinis</title>

</head>

<body>
    <div class="logo">
        <img class="logo" src="{{ asset('img/logo.png') }}" alt="Logo">
    </div>
    <header>
        <div class="nav_container">
            <nav class="navbar">

                <ul class="nav-menu">
                    <li id="dropDown" class="nav-item ">
                        <a href="{{ route('declare.index') }}" class="nav-link "><i class="fa-thin fa-hashtag icon"></i>Pirmininkas</a>
                        <ul class="dropDown">
                            <li><a class="nav-link " href="{{ route('pricelist.create') }}"><i
                                class="fa-solid fa-money-check-dollar icon"></i>N. saskaita</a></li>
                            <li><a class="nav-link" href="{{ route('declare.index') }}"><i class="fa-solid fa-faucet"></i>Deklaravimas</a></li>
                            <li><a class="nav-link" href="{{ route('pricelist.index') }}"><i
                                class="fa-solid fa-money-check-dollar icon"></i>Saskaitos</a>





                            </li>
                            <li><a class="nav-link" href="{{ route('invoices.index') }}"><i
                                class="fa-solid fa-key"></i>B. Saskaitos</a></li>
                            <li><a class="nav-link" href="{{ route('user.index') }}"><i class="fa-solid fa-person"></i>Gyventojai</a></li>
                            <li><a class="nav-link" href="{{ route('flat.index') }}"><i class="fa-solid fa-suitcase"></i>Butai</a></li>
                            <li><a class="nav-link" href="{{ route('house.index') }}"><i class="fa-solid fa-house"></i>Namai</a></li>
                            <li><a class="nav-link" href="{{ route('nkf.index') }}"><i class="fa-solid fa-piggy-bank"></i>NKF</a></li>

                        </ul>

                    </li>

                    <li class="nav-item">
                        <a href="{{ route('posts.index') }}" class="nav-link {{ Request::is('home') ? 'active_nav':'' }}"><i class="fa-regular fa-comment icon"></i>Naujienos</a>

                    </li>
                    <li id="dropDown" class="nav-item ">
                        <a href="{{ route('declare.index') }}" class="nav-link {{ Request::is('declare/index') ? 'active_nav':'' }}"><i class="fa-solid fa-faucet"></i></i>Deklaravimas</a>
                        <ul class="dropDown">
                            <li><a class="nav-link" href="{{ route('declare.create') }}"><i class="fa-solid fa-faucet"></i></i>Deklaruok</a></li>
                            <li><a class="nav-link" href="{{ route('declare.indexFlat') }}"><i class="fa-solid fa-faucet"></i></i>Istorija</a></li>

                        </ul>

                    </li>

                    <li class="nav-item ">
                        <a href="{{ route('pricelist.index') }}" class="nav-link {{ Request::is('pricelist/index') ? 'active_nav':'' }}"><i
                                class="fa-solid fa-money-check-dollar icon"></i>Sąskaitos</a>
                        <ul class="dropDown">
                            <li><a class="nav-link" href="{{ route('bills.index') }}"><i
                                class="fa-solid fa-money-check-dollar icon"></i>Naujausia</a></li>
                            <li><a class="nav-link" href="{{ route('invoices.indexFlat') }}"><i
                                class="fa-solid fa-money-check-dollar icon"></i>Istorija</a></li>

                        </ul>

                    </li>

                    <li class="nav-item">
                        <a href="{{ route('contacts.index') }}" class="nav-link {{ Request::is('contacts/index') ? 'active_nav':'' }}"><i
                                class="fa-solid fa-address-book icon"></i>Kontaktai</a>

                    </li>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <ul>

                    <li><a href="#" class="nav-link right"><i
                                class="fa-solid fa-right-from-bracket icon iconDark logout"></i>{{ Auth::user()->name }} </a>
                        <ul class="dropDown">
                            <li><a class="nav-link" href="{{ route('user.show') }}"><i class="fa-solid fa-face-smile"></i>Apie Mane</a></li>
                            <li><a class="nav-link" href="{{ route('house.index') }}"><i class="fa-solid fa-house"></i>Apie Nama</a></li>
                            <li><a class="nav-link" href="{{ route('roles.index') }}"><i class="fa-solid fa-palette"></i>Roles</a></li>
                            <li><a class="nav-link" href="{{ route('permissions.index') }}"><i class="fa-solid fa-scale-balanced"></i>Leidimai</a></li>
                            <li><a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i
                                        class="fa-solid fa-right-from-bracket icon iconDark logout"></i>Atsijungti</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </ul>
                <script src="/resources/js/app.js"></script>
                <script src="{{ asset('js/hamburger.js') }}" defer></script>
            </nav>
        </div>
        @if (session()->has('bad_message'))
        <div id="bad_message" class="message_show alert alert-danger"><i class="fa-regular fa-face-frown-open alert-danger"></i> {{ session()->get('bad_message') }}</div>
    @endif
    @if (session()->has('good_message'))
    <div id="good_message" class="message_show alert alert-success"><i class="fa-regular fa-face-grin-wide alert-success"></i> {{ session()->get('good_message') }}</div>
@endif
    </header>


    @yield('content')
    <footer>
        <div class="copyright"><small> Copyright &copy;TG 2022 PAGE IS UNDER CONSTRUCTION</small></div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/message_show.js') }}"></script>





</body>

</html>
