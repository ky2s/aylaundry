@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Kasir</h1>

    <div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('kasir.create') }}" class="btn btn-primary">Tambah Kasir</a>
        </div>
        <div class="col-md-6">
            <form method="GET" action="{{ route('kasir.index') }}" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary">Cari</button>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kasirs as $index => $kasir)
                <tr>
                    <td>{{ $kasirs->firstItem() + $index }}</td>
                    <td>{{ $kasir->name }}</td>
                    <td>{{ $kasir->email }}</td>
                    <td>
                        <a href="{{ route('kasir.edit', $kasir->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('kasir.destroy', $kasir->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus kasir ini?')">Hapus</button>
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
        {{ $kasirs->links() }}
    </div>
</div>
@endsection
