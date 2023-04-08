<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}"><i class="fa fa-bed"></i>
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('daftar-kost.index') ? 'active' : '' }}" href="{{ route('daftar-kost.index') }}">{{ __('Daftarkan Kost') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @admin
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.kost.index') ? 'active' : '' }} {{ Route::is('admin.kost.show') ? 'active' : '' }}" href="{{ route('admin.kost.index') }}">{{ __('List Kost') }}</a>
                        </li>
                        @endadmin
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">{{ __('Riwayat Komentar') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="pb-4">
            @yield('content')
        </main>
    </div>
</body>
<footer class="mt-4">
    <div class="d-block bg-dark p-3">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-5">
                    <div class="text-white mb-4">
                        <h4 class="fw-bold"><i class="fa fa-bed"></i> Kost-Ong</h4>
                        <p>
                            Temukan kost ideal Anda di website kami yang gratis dan mudah digunakan. Pencarian responsif, terintegrasi dengan layanan transportasi dan peta digital, dan memungkinkan pengguna memberikan rating dan ulasan. Dengan fitur rating, website kami adalah solusi terbaik untuk pencarian kost yang aman, efisien, dan berbasis pengalaman pengguna.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-3">
                    <div class="text-white">
                        <h5 class="fw-bold"><i class="fa fa-address-book"></i> Kontak Kami</h5>
                        <span><i class="fa fa-phone"></i>&nbsp&nbsp&nbsp&nbsp08xx xxxx xxxx</span><br>
                        <span><i class="fa fa-envelope"></i>&nbsp&nbsp&nbspadmin@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</html>
