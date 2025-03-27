@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center vh-100 px-3">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4 text-center">
                <h4 class="mb-3 fw-bold">Masuk</h4>
                <p class="text-muted small">Masukkan kredensial Anda untuk mengakses akun</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-2 text-start">
                        <label for="email" class="form-label small">Alamat Email</label>
                        <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-2 text-start">
                        <label for="password" class="form-label small">Kata Sandi</label>
                        <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-2 small">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Ingat Saya
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none" href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
                        @endif
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-sm">Masuk</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <span class="text-muted small">Belum punya akun?</span>
                    <a class="text-decoration-none fw-bold small" href="{{ route('register') }}">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection