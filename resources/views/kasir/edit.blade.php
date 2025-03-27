@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Service</h1>
    <form action="{{ route('kasir.update', $kasir->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('kasir.form')
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('kasir.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
