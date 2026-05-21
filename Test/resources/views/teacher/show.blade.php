@extends('layouts.layouts')
@title('Teacher Details')
@section('content')
    <div class="container mt-5">
        <h1>Teacher Details</h1>
        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $teacher->id }}</p>
                <p><strong>Name:</strong> {{ $teacher->name }}</p>
                <p><strong>Email:</strong> {{ $teacher->email }}</p>
                <p><strong>Phone:</strong> {{ $teacher->phone }}</p>
                <p><strong>Balance:</strong> ${{ number_format($teacher->balance, 2) }}</p>
            </div>
        </div>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
