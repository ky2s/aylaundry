@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Laporan Keuangan</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Pendapatan Hari Ini</div>
                <div class="card-body">
                    <h4 class="card-title">Rp {{ number_format($dailyIncome, 2, ',', '.') }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Pendapatan Minggu Ini</div>
                <div class="card-body">
                    <h4 class="card-title">Rp {{ number_format($weeklyIncome, 2, ',', '.') }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Pendapatan Bulan Ini</div>
                <div class="card-body">
                    <h4 class="card-title">Rp {{ number_format($monthlyIncome, 2, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
