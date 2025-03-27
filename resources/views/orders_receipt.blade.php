@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nota Pesanan</h2>
    <p><strong>Nama:</strong> {{ $order->name }}</p>
    <p><strong>Telepon:</strong> {{ $order->phone }}</p>
    <p><strong>Alamat:</strong> {{ $order->address }}</p>
    <p><strong>Tanggal:</strong> {{ date('d-m-Y', strtotime($order->created_at)) }}</p>
    
    <table>
        <thead>
            <tr>
                <th>Nama Layanan</th>
                <th>Harga/Kg</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $detail)
            <tr>
                <td>{{ $detail->service_name }}</td>
                <td>Rp {{ number_format($detail->price_per_kg, 0, ',', '.') }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                <td><strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>
    
    <button class="btn btn-warning" onclick="window.print()">Cetak Nota</button>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
    
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        width: 80%;
        margin: auto;
        text-align: center;
    }
    .container {
        border: 1px solid #000;
        padding: 20px;
        margin-top: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    .text-right {
        text-align: right;
    }
    .print-button {
        margin-top: 20px;
    }
</style>
@endsection
