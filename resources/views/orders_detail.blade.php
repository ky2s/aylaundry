@extends('layouts.app')

@section('content')
<div class="container mt-5">

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
    <h2 class="mb-4">Order Details</h2>
    <table class="table table-bordered">
        <tr>
            <th>Order ID</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>Customer</th>
            <td>{{ $order->customer->name }}</td>
        </tr>
        <tr>
            <th>Order Date</th>
            <td>{{ $order->created_at }}</td>
        </tr>
        <tr>
            <th>Total Weight (kg)</th>
            <td>{{ $order->total_weight ?? '-' }}</td>
        </tr>
        <tr>
            <th>Total Price</th>
            <td>Rp {{ number_format($order->total_price, 2) }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <span class="badge bg-{{ $order->status == 'done' ? 'success' : ($order->status == 'canceled' ? 'danger' : 'warning') }}">{{ ucfirst($order->status) }}</span>
                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('POST')
                    <select name="status" class="form-select form-select-sm w-auto d-inline" onchange="this.form.submit()">
                        @foreach($statuses as $status)
                            <option value="{{ $status->name }}" {{ $order->status == $status->name ? 'selected' : '' }}>{{ ucfirst($status->name) }}</option>
                        @endforeach
                    </select>
                </form>
            </td>
        </tr>
        <tr>
            <th>Notes</th>
            <td>{{ $order->notes ?? '-' }}</td>
        </tr>
        <tr>
            <th>Pickup</th>
            <td>{{ $order->pickup ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <th>Delivery</th>
            <td>{{ $order->delivery ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <th>Completed At</th>
            <td>{{ $order->completed_at ?? '-' }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $order->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $order->updated_at ?? '-' }}</td>
        </tr>
    </table>

    

    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
</div>

@endsection
