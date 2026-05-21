@extends('layouts.layouts')
@section('title', 'Create Header')
@section('content')
    <h1>Create Header</h1>
    <x-alert type="error"/>
    <form action="{{ route('headers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
