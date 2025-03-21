@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pesanan Laundry</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Order Date</th>
                <th>Weight (kg)</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Pickup</th>
                <th>Delivery</th>
                <th>Notes</th>
                <th>Completed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td><a href="{{url('/orders/show/'.$order->id)}}">{{ $order->id }}</a></td>
                <td>{{ optional($order->customer)->name ?? 'Unknown Customer' }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->total_weight ?? '-' }}</td>
                <td>Rp {{ number_format($order->total_price, 2) }}</td>
                <td>
                    <span class="badge bg-{{ $order->status == 'done' ? 'success' : ($order->status == 'canceled' ? 'danger' : 'warning') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>{{ $order->pickup ? 'Yes' : 'No' }}</td>
                <td>{{ $order->delivery ? 'Yes' : 'No' }}</td>
                <td>{{ $order->notes ?? '-' }}</td>
                <td>{{ $order->completed_at ? $order->completed_at->format('d M Y H:i') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
