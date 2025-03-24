@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Create New Order</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer</label>
            <input type="text" class="form-control" id="customer_search" placeholder="Search customer name or phone" autocomplete="off">
            <input type="hidden" name="customer_id" id="customer_id">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let typingTimer;
        const doneTypingInterval = 300;

        $("#customer_search").on("keyup", function() {
            clearTimeout(typingTimer);
            let query = $(this).val();

            if (query.length >= 3) {
                console.log(query);
                typingTimer = setTimeout(() => {
                    $.get("{{ route('customers.search') }}", { q: query }, function(data) {
                        console.log(data);
                        let dropdown = '<ul class="list-group position-absolute w-100">';
                        data.forEach(customer => {
                            dropdown += `<li class="list-group-item list-group-item-action" data-id="${customer.id}">${customer.name} - ${customer.phone}</li>`;
                        });
                        dropdown += '</ul>';
                        $("#customer_search").after(dropdown);

                        $(".list-group-item").on("click", function() {
                            let selectedCustomer = $(this).text();
                            let customerId = $(this).data('id');
                            $("#customer_search").val(selectedCustomer);
                            $("#customer_id").val(customerId);
                            $(".list-group").remove();
                        });
                    });
                }, doneTypingInterval);
            } else {
                $(".list-group").remove();
            }
        });

        $(document).on("click", function() {
            $(".list-group").remove();
        });

        // Autofill total price based on weight and price per kg
        $("#total_weight").on("keyup", function() {
            let weight = parseFloat($(this).val()) || 0;
            $.get("{{ route('prices.get') }}", function(data) {
                console.log(data.price_per_kg);
                let pricePerKg = parseFloat(data.price_per_kg) || 0;
                let totalPrice = weight * pricePerKg;
                $("#total_price").val(totalPrice.toFixed(2));
            });
        });
    });
</script>

@endsection
