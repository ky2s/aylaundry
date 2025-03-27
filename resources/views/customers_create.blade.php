@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Customer Baru</h1>

    <!-- Tampilkan error validasi -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form tambah customer -->
    <form action="{{ route('customers.store') }}" method="POST" class="p-4 bg-light shadow-sm rounded">
        @csrf
    
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
    
        <div class="mb-3">
            <label for="phone" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
        </div>
    
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            <div id="emailHelp" class="form-text">Opsional, kalau ada emailnya aja.</div>
        </div>
    
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea class="form-control" id="address" name="address">{{ old('address') }}</textarea>
        </div>
    
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>    
@endsection
