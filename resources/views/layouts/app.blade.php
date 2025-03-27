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
        <header class="d-flex flex-wrap justify-content-center border-bottom">
            <div class="container d-flex flex-wrap align-items-center justify-content-between">
                <a href="{{ url('/') }}" class="d-flex align-items-center mb-2 mb-md-0 text-dark text-decoration-none">
                    <span class="fs-4 fw-bold">{{ config('app.name', 'Laravel') }}</span>
                </a>
        
                <ul class="nav nav-pills">
                    @auth
                        <li class="nav-item"><a href="{{ route('customers.index') }}" class="nav-link">Customers</a></li>
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item"><a href="{{ route('services.index') }}" class="nav-link">Services</a></li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarOrders" role="button" data-bs-toggle="dropdown">
                                Orders
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('orders.index') }}">All Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('orders.create') }}">New Order</a></li>
                            </ul>
                        </li>
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item"><a href="{{ route('report.index') }}" class="nav-link">Laporan Keuangan</a></li>
                            <li class="nav-item"><a href="{{ route('kasir.index') }}" class="nav-link">Daftar Kasir</a></li>
                        @endif
                    @endauth
                </ul>
        
                <div>
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Sign up</a>
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
                                        Logout
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
