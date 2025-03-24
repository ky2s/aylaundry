@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Service</h1>
    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('services.form')
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
