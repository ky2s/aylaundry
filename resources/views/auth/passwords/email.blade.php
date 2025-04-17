@extends('layouts.app')

<div class="card">
    <h4 class="text-center mb-2">Atur Ulang Kata Sandi</h4>
    <p class="text-center mb-3">Masukkan email Anda untuk menerima tautan reset kata sandi</p>

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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>