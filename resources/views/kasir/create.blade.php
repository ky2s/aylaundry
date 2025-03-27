@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Tambah Kasir</h1>
    <form action="{{ route('kasir.store') }}" method="POST">
        @csrf
        @include('kasir.form')
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kasir.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection
