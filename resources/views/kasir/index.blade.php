@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Kasir</h1>
    <a href="{{ route('kasir.create') }}" class="btn btn-primary">Tambah Kasir</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kasirs as $index => $kasir)
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
            @endforeach
        </tbody>
    </table>

    <!-- Tambahin navigasi pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $kasirs->links() }}
    </div>
</div>
@endsection
