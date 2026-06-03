@extends('layouts.layouts')
@section('title','Edit Document')
@section('content')
    <h1>Edit Document</h1>
    <form action="{{ route('documents.update', ['teacher' => $teacher, 'document' => $document]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="name" value="{{ $document->name }}" required>
        </div>
        <div>
            <label for="file">File:</label>
            <input type="file" id="file" name="path">
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" value="{{ $document->price }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
