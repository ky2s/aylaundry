@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 px-3 pt-4">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4 text-center">
                <h4 class="mb-3 fw-bold">Atur Ulang Kata Sandi</h4>
                <p class="text-muted small">Masukkan email Anda untuk menerima tautan reset kata sandi</p>
                
                @if (session('status'))
                    <div class="alert alert-success small" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <div class="mb-2 text-start">
                        <label for="email" class="form-label small">Alamat Email</label>
                        <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-sm">Kirim Tautan Reset Kata Sandi</button>
                    </div>
                </form>

                <div class="text-center mt-3 small">
                    <span class="text-muted">Sudah punya akun?</span>
                    <a class="text-decoration-none fw-bold" href="{{ route('login') }}">Masuk</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
