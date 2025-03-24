@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Customer</h1>

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

    <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="p-4 bg-light shadow-sm rounded">
        @csrf
        @method('POST')
    
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
        </div>
    
        <div class="mb-3">
            <label for="phone" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required>
        </div>
    
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}">
            <div id="emailHelp" class="form-text">Opsional, kalau ada emailnya aja.</div>
        </div>
    
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea class="form-control" id="address" name="address">{{ old('address', $customer->address) }}</textarea>
        </div>
    
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Batal</a>
    </form>
    
</div>
@endsection
