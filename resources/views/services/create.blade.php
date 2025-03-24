@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Service</h1>
    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        @include('services.form')
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
