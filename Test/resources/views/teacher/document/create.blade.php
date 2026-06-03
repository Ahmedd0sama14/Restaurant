@extends('layouts.layouts')
@section('title', 'Create Document')
@section('content')
<div class="container mt-5">

    <h1>Create Document</h1>
    <form action="{{ route('documents.store', ['teacher' => $teacher]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="name" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        <div>
            <label for="file">File:</label>
            <input type="file" id="file" name="path" required>
        </div>

        <button type="submit">Create</button>
    </form>
</div>
@endsection
