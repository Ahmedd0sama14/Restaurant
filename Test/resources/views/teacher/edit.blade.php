@extends('layouts.layouts')
@section('title')
    Edit Teacher
@endsection
@section('content')
<x-alert type="error"/>
    <div class="container mt-5">
        <h1>Edit Teacher</h1>
        <form action="{{ route('teachers.update', $teacher) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $teacher->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $teacher->email }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $teacher->phone }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password (leave blank to keep current password)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
