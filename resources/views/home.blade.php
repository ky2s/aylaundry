@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pesanan Laundry</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Jenis Layanan</th>
                <th>Tanggal Masuk</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Budi Santoso</td>
                <td>Cuci Kering</td>
                <td>20 Maret 2025</td>
                <td>Selesai</td>
                <td><button>Lihat Detail</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Siti Aminah</td>
                <td>Setrika</td>
                <td>21 Maret 2025</td>
                <td>Dalam Proses</td>
                <td><button>Lihat Detail</button></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
