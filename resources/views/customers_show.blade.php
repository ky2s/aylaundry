@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Customer</h1>

    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">Edit Customer</a>
    <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>

    <!-- Tombol Hapus -->
    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Yakin hapus customer ini?')" class="btn btn-danger">Hapus Customer</button>
    </form>

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
    

    <h2>Riwayat Transaksi</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Layanan</th>
                <th>Berat (Kg)</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customer->orders as $order)
                <tr>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->service->service_name }}</td>
                    <td>{{ $order->total_weight ?? '-' }}</td>
                    <td>Rp {{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $order->status == 'done' ? 'success' : ($order->status == 'canceled' ? 'danger' : 'warning') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->notes ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada transaksi</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
