<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div id="app">
        @auth
        <header class="navbar navbar-expand-lg navbar-light bg-white__ border-bottom">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item"><a href="{{ route('customers.index') }}" class="nav-link">Pelanggan</a></li>
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item"><a href="{{ route('services.index') }}" class="nav-link">Layanan</a></li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarOrders" role="button" data-bs-toggle="dropdown">Pesanan</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('orders.index') }}">Semua Pesanan</a></li>
                                    <li><a class="dropdown-item" href="{{ route('orders.create') }}">Pesanan Baru</a></li>
                                </ul>
                            </li>
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item"><a href="{{ route('report.index') }}" class="nav-link">Laporan Keuangan</a></li>
                                <li class="nav-item"><a href="{{ route('kasir.index') }}" class="nav-link">Daftar Kasir</a></li>
                            @endif
                        @endauth
                    </ul>
                    <div class="ms-lg-3">
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Masuk</a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                            @endif
                        @else
                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown">
                                    <span class="me-2">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" 
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Keluar
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </header>
        @endauth

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
