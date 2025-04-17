@extends('layouts.app')

<div class="card">
    <h4 class="text-center mb-2">Masuk</h4>
    <p class="text-center mb-3">Buat akun untuk memulai <a href="{{ route('register') }}">Daftar</a></p>

    <div class="d-flex gap-2 mb-3">
      <button class="btn btn-outline-secondary w-100"><img src="https://img.icons8.com/color/16/000000/google-logo.png"/> Use Google</button>
      <button class="btn btn-outline-secondary w-100"><img src="https://img.icons8.com/ios-filled/16/000000/mac-os.png"/> Use Apple</button>
    </div>

    <div class="divider">OR</div>

    <form method="POST" action="{{ route('login') }}">
       @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" placeholder="emailku@mail.com" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <div class="invalid-feedback small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <div class="d-flex justify-content-between">
          <label for="password" class="form-label">Kata Sandi</label>
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="small">Lupa Kata Sandi?</a>
            @endif
        </div>
        <input id="password" type="password"  placeholder="Kata sandi" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        @error('password')
            <div class="invalid-feedback small">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" id="remember" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">Ingat saya</label>
      </div>

      <button type="submit" class="btn btn-primary w-100">Masuk</button>
      
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>