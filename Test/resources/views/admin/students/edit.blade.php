@extends('layouts.layouts')
@section('title', 'Edit Student')
@section('content')
    <div class="container mt-4">
        <h1>Edit Student</h1>
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
            </div>
           <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $student->phone }}" required>
           </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="form-text text-muted">Leave blank to keep current password</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Student</button>
        </form>
    </div>
@endsection
