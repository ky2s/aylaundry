@extends('layouts.app')

@section('content')
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

    <!-- Form edit customer -->
    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('POST')

        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
        <br><br>

        <label for="phone">Telepon:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}">
        <br><br>

        <label for="address">Alamat:</label>
        <textarea id="address" name="address">{{ old('address', $customer->address) }}</textarea>
        <br><br>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('customers.index') }}">Batal</a>
    </form>
@endsection
