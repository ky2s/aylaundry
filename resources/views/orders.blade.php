@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pesanan Laundry</h1>

    <div class="row mb-3">
        <div class="col-md-6">
            <!-- Tombol Tambah Pesanan -->
            <a href="{{ route('orders.create') }}" class="btn btn-primary">Tambah Pesanan Baru</a>
        </div>
        <div class="col-md-6">
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('orders.index') }}" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama customer..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary">Cari</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Weight (kg)</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Pickup</th>
                <th>Delivery</th>
                <th>Order Date</th>
                <th>Completed At</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td><a href="{{url('/orders/'.$order->id)}}">{{ $order->id }}</a></td>
                <td>{{ optional($order->customer)->name ?? 'Unknown Customer' }}</td>
                <td>{{ $order->total_weight ?? '-' }}</td>
                <td>Rp {{ number_format($order->total_price, 2) }}</td>
                <td>
                    <span class="badge bg-{{ $order->status == 'done' ? 'success' : ($order->status == 'canceled' ? 'danger' : 'warning') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>{{ $order->pickup ? 'Yes' : 'No' }}</td>
                <td>{{ $order->delivery ? 'Yes' : 'No' }}</td>
                <td>{{ $order->created_at ? $order->created_at->format('d M Y H:i') : '-' }}</td>
                <td>{{ $order->completed_at ? $order->completed_at->format('d M Y H:i') : '-' }}</td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-info">Detail</a>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada pesanan ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $orders->links() }}
    </div>
</div>
@endsection
