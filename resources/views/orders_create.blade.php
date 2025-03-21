@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Create New Order</h2>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer ID</label>
            <input type="number" class="form-control" name="customer_id" id="customer_id" required>
        </div>

        <div class="mb-3">
            <label for="total_weight" class="form-label">Total Weight (kg)</label>
            <input type="number" class="form-control" name="total_weight" id="total_weight" step="0.01">
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">Total Price</label>
            <input type="number" class="form-control" name="total_price" id="total_price" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" id="status">
                <option value="pending">Pending</option>
                <option value="process">Process</option>
                <option value="done">Done</option>
                <option value="canceled">Canceled</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" name="notes" id="notes"></textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="pickup" id="pickup">
            <label for="pickup" class="form-check-label">Pickup</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="delivery" id="delivery">
            <label for="delivery" class="form-check-label">Delivery</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit Order</button>
    </form>
</div>
@endsection
