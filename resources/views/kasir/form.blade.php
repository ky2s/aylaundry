<div class="mb-3">
    <label for="name" class="form-label">Nama Kasir</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $kasir->name ?? '') }}" required>
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email Kasir</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $kasir->email ?? '') }}" required>
    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
    @error('password')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
</div>
