@extends('layouts.layouts')
@section('title')
    Student Details
@endsection
@section('content')
    <div class="container mt-4">
        <h1>Student Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $student->name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $student->email }}</p>
                <p class="card-text"><strong>Courses:</strong> {{ $student->course ? $student->course->name : 'N/A' }}</p>
                <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
