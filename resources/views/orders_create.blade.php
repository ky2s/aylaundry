@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Buat Pesanan Baru</h2>

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
            <label for="customer_id" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="customer_search" placeholder="Search customer name or phone" autocomplete="off">
            <input type="hidden" name="customer_id" id="customer_id">
        </div>

        <div id="services-container">
            <div class="service-row mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="services[0][id]" class="form-label">Layanan</label>
                        <select class="form-select" name="services[0][id]" required>
                            <option value="">Pilih Layanan</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->service_name }} - Rp{{ number_format($service->price_per_kg, 2) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="services[0][weight]" class="form-label">Berat (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="services[0][weight]" min="0">
                    </div>
                    <div class="col-md-3">
                        <label for="services[0][quantity]" class="form-label">Kuantitas</label>
                        <input type="number" class="form-control" name="services[0][quantity]" min="1" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-service">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" id="add-service">Tambah Layanan</button>

        <div class="mb-3">
            <label for="total_weight" class="form-label">Total Berat (kg)</label>
            <input type="text" class="form-control" id="total_weight" name="total_weight" readonly>
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">Total Harga (Rp)</label>
            <input type="text" class="form-control" id="total_price" name="total_price" readonly>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" name="notes" id="notes"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Delivery</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="delivery" id="delivery_yes" value="yes">
                <label for="delivery_yes" class="form-check-label">Ya</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="delivery" id="delivery_no" value="no" checked>
                <label for="delivery_no" class="form-check-label">Tidak</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
    </form>
</div>

@push('scripts')
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let serviceIndex = 1;

        document.getElementById('add-service').addEventListener('click', function () {
            const container = document.getElementById('services-container');
            const newServiceRow = document.createElement('div');
            newServiceRow.classList.add('service-row', 'mb-3');
            newServiceRow.innerHTML = `
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-select" name="services[${serviceIndex}][id]" required>
                            <option value="">Pilih Layanan</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->service_name }} - Rp{{ number_format($service->price_per_kg, 2) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="services[${serviceIndex}][quantity]" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" step="0.01" class="form-control" name="services[${serviceIndex}][weight]" min="0">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-service">Hapus</button>
                    </div>
                </div>`;
            container.appendChild(newServiceRow);
            serviceIndex++;
        });

        document.getElementById('services-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-service')) {
                e.target.closest('.service-row').remove();
                calculateTotals();
            }
        });

        document.getElementById('services-container').addEventListener('input', function () {
            calculateTotals();
        });

        function calculateTotals() {
            let totalWeight = 0;
            let totalPrice = 0;
            document.querySelectorAll('.service-row').forEach(function (row) {
                const quantity = parseFloat(row.querySelector('input[name*="[quantity]"]').value) || 0;
                const weight = parseFloat(row.querySelector('input[name*="[weight]"]').value) || 1;
                const servicePrice = parseFloat(row.querySelector('select option:checked').textContent.split(' - Rp')[1].replace(/,/g, '')) || 0;

                totalWeight += weight * quantity;
                totalPrice += servicePrice * weight * quantity;
            });

            document.getElementById('total_weight').value = totalWeight.toFixed(2);
            document.getElementById('total_price').value = totalPrice.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        }
    });
</script>
@endpush
@endsection
