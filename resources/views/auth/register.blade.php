@extends('layouts.app')


<div class="card">
    <h4 class="text-center mb-2">Daftar</h4>
    <p class="text-center mb-3">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>

    <div class="d-flex gap-2 mb-3">
      <button class="btn btn-outline-secondary w-100"><img src="https://img.icons8.com/color/16/000000/google-logo.png"/> Use Google</button>
      <button class="btn btn-outline-secondary w-100"><img src="https://img.icons8.com/ios-filled/16/000000/mac-os.png"/> Use Apple</button>
    </div>

    <div class="divider">OR</div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="mb-2 text-start">
            <label for="name" class="form-label small">Nama Lengkap</label>
            <input id="name" type="text" placeholder="Nama lengkap" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <div class="invalid-feedback small">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-2 text-start">
            <label for="email" class="form-label small">Alamat Email</label>
            <input id="email" type="email" placeholder="Alamat" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <div class="invalid-feedback small">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-2 text-start">
            <label for="password" class="form-label small">Kata Sandi</label>
            <input id="password" type="password" placeholder="kata sandi" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback small">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-2 text-start">
            <label for="password-confirm" class="form-label small">Konfirmasi Kata Sandi</label>
            <input id="password-confirm" type="password" placeholder="Konfirmasi sandi" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password">
        </div>
        
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-sm">Daftar</button>
        </div>
    </form>
    
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
