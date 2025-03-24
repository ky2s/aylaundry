@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Customer</h1>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Nama</th>
            <td>{{ $customer->name }}</td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td>{{ $customer->phone }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $customer->email ?? '-' }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $customer->address ?? '-' }}</td>
        </tr>
        <tr>
            <th>Dibuat</th>
            {{-- <td>{{ $customer->created_at->format('d-m-Y H:i') }}</td> --}}
        </tr>
    </table>

    <br>
    <a href="{{ route('customers.edit', $customer->id) }}">Edit Customer</a>
    <a href="{{ route('customers.index') }}">Kembali</a>

    <!-- Tombol Hapus -->
    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Yakin hapus customer ini?')">Hapus Customer</button>
    </form>
</div>
@endsection
