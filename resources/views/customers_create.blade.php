@extends('layouts.app')

@section('content')
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
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        <br><br>

        <label for="phone">Telepon:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        <br><br>

        <label for="address">Alamat:</label>
        <textarea id="address" name="address">{{ old('address') }}</textarea>
        <br><br>

        <button type="submit">Simpan</button>
        <a href="{{ route('customers.index') }}">Batal</a>
    </form>
@endsection
