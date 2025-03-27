@extends('layouts.app')

@section('content')
<div class="container ">
    <h1 class="text-center mb-4">Daftar Pesanan Laundry</h1>
    <div class="row mb-3">
        <div class="col-md-6 mb-2">
            <a href="{{ route('orders.create') }}" class="btn btn-primary">Tambah Pesanan Baru</a>
        </div>
        <div class="col-md-6">
            <form method="GET" action="{{ route('orders.index') }}" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama customer..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary">Cari</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Berat (kg)</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Pickup</th>
                    <th>Delivery</th>
                    <th>Tanggal Pesanan</th>
                    <th>Selesai Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><a href="{{url('/orders/'.$order->id)}}">{{ $order->id }}</a></td>
                    <td>{{ optional($order->customer)->name ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $order->total_weight ?? '-' }}</td>
                    <td>Rp {{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $order->status == 'done' ? 'success' : ($order->status == 'canceled' ? 'danger' : 'warning') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->pickup ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $order->delivery ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $order->created_at ? $order->created_at->format('d M Y H:i') : '-' }}</td>
                    <td>{{ $order->completed_at ? $order->completed_at->format('d M Y H:i') : '-' }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-info">Detail</a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">Tidak ada pesanan ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $orders->links() }}
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .card {
            width: 100%;
            padding: 1rem;
        }
        .card-body {
            padding: 2rem;
        }
        .btn {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }
        .table-responsive {
            overflow-x: auto;
        }
    }
</style>
@endsection
