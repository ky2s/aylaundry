@extends('layouts.app')

@section('content')
<div class="container">
<h1>Daftar Customer</h1>

    <div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Tambah Customer</a>
        </div>
        <div class="col-md-6">
            <form method="GET" action="{{ route('customers.index') }}" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, telepon atau email..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary">Cari</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div class="table-responsive">
        <table border="1" cellpadding="10" class="table table-striped table-bordered">
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
                @forelse($customers as $i =>$customer)
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
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada data yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tambahin navigasi pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $customers->links() }}
    </div>
</div>
@endsection
