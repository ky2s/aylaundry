@extends('layouts.app')

@section('content')
<div class="container">
<h1>Daftar Customer</h1>
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Tambah Customer</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $i =>$customer)
                <tr>
                    <td>{{ $customers->firstItem() + $i }}</td>
                    <td><a href="{{ route('customers.show', $customer->id) }}">{{ $customer->name }}</a></td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tambahin navigasi pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $customers->links() }}
    </div>
</div>
@endsection
