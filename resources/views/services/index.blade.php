@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Services List</h1>
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Tambah Service</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price per Kg</th>
                <th>Price per Item</th>
                <th>Estimated Time</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->service_name }}</td>
                    <td>{{ $service->price_per_kg }}</td>
                    <td>{{ $service->price_per_item }}</td>
                    <td>{{ $service->estimated_time }} hours</td>
                    <td>{{ $service->category_id ?? 'Uncategorized' }}</td>
                    <td>{{ $service->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        {{-- <a href="{{ route('services.show', $service->id) }}" class="btn btn-info btn-sm">View</a> --}}
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
