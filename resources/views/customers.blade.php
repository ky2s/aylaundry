@extends('layouts.app')

@section('content')
<div class="container">
<h1>Daftar Customer</h1>
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Tambah Customer</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td><a href="{{ route('customers.show', $customer->id) }}">{{ $customer->name }}</a></td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        <a href="{{ route('customers.edit', $customer) }}">Edit</a> | 
                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('POST')
                            <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
