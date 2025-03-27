@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center vh-100 px-3">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4 text-center">
                <h4 class="mb-3 fw-bold">Daftar</h4>
                <p class="text-muted small">Buat akun untuk memulai</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="mb-2 text-start">
                        <label for="name" class="form-label small">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-2 text-start">
                        <label for="email" class="form-label small">Alamat Email</label>
                        <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-2 text-start">
                        <label for="password" class="form-label small">Kata Sandi</label>
                        <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-2 text-start">
                        <label for="password-confirm" class="form-label small">Konfirmasi Kata Sandi</label>
                        <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-sm">Daftar</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <span class="text-muted small">Sudah punya akun?</span>
                    <a class="text-decoration-none fw-bold small" href="{{ route('login') }}">Masuk</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
